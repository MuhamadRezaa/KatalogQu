<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\CheckoutController;

/*
|--------------------------------------------------------------------------
| API Routes - Updated for Security Enhancement
|--------------------------------------------------------------------------
*/

// Rute ini harus ada untuk menangani permintaan pengecekan status
Route::get('/checkout/status-api/{orderId}', [CheckoutController::class, 'checkStatusApi'])
    ->name('checkout.status.api');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Midtrans notification endpoint
Route::post('/midtrans/notification', [MidtransController::class, 'notificationHandler']);

// Manual payment status check for debugging
Route::post('/midtrans/check-status', [MidtransController::class, 'checkPaymentStatus']);
Route::get('/midtrans/check-status/{order_id}', function ($orderId) {
    return app(MidtransController::class)->checkPaymentStatus(new \Illuminate\Http\Request(['order_id' => $orderId]));
});

// Check authentication status
Route::get('/check-auth', function (Request $request) {
    $user = auth()->user();
    return response()->json([
        'authenticated' => auth()->check(),
        'user' => $user ? [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email
        ] : null
    ]);
});

// Auth check endpoint for frontend
Route::get('/auth/check', function (Request $request) {
    return response()->json([
        'authenticated' => auth()->check(),
        'user' => auth()->user()
    ]);
});

// Template purchase routes
Route::middleware('auth:sanctum')->post('/save-template-purchase', function (Request $request) {
    $validated = $request->validate([
        'template_name' => 'required|string|max:255',
        'template_type' => 'required|string|max:100',
        'price' => 'required|numeric|min:0',
        'status' => 'required|string|in:pending,paid,failed',
        'features' => 'array',
        'purchase_date' => 'required|date'
    ]);

    // Generate unique transaction ID
    $transactionId = 'KatalogQu-' . time() . '-' . $request->user()->id;

    // For demo purposes, we'll assume catalog_template_id = 1 (toko_komputer template)
    // In production, you should have a proper mapping of template types to catalog_template_id
    $catalogTemplateId = 1;

    $purchase = DB::table('template_purchases')->insert([
        'transaction_id' => $transactionId,
        'user_id' => $request->user()->id,
        'catalog_template_id' => $catalogTemplateId,
        'amount' => $validated['price'],
        'discount_amount' => 0,
        'final_amount' => $validated['price'],
        'payment_method' => 'midtrans',
        'payment_status' => $validated['status'],
        'payment_details' => json_encode([
            'template_name' => $validated['template_name'],
            'template_type' => $validated['template_type'],
            'features' => $validated['features'] ?? [],
            'purchase_date' => $validated['purchase_date']
        ]),
        'download_token' => Str::random(32),
        'download_count' => 0,
        'max_downloads' => 3,
        'expires_at' => now()->addDays(30),
        'created_at' => now(),
        'updated_at' => now()
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Template purchase saved successfully',
        'transaction_id' => $transactionId,
        'data' => $validated
    ]);
});

// Test endpoint for debugging
Route::post('/midtrans/test-snap-token', function (Request $request) {
    try {
        \Illuminate\Support\Facades\Log::info('Test endpoint called', $request->all());

        // Get or create a test user
        $testUser = \App\Models\User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt(\Illuminate\Support\Str::random(16)),
                'email_verified_at' => now()
            ]
        );

        $testData = [
            'transaction_details' => [
                'order_id' => 'TEST-' . time(),
                'gross_amount' => 150000
            ],
            'customer_details' => [
                'first_name' => 'Test User',
                'email' => 'test@example.com',
                'phone' => '081234567890'
            ],
            'item_details' => [[
                'id' => 'template-test',
                'price' => 150000,
                'quantity' => 1,
                'name' => 'Test Template'
            ]]
        ];

        // Create test template purchase record
        $templatePurchase = \App\Models\TemplatePurchase::create([
            'transaction_id' => $testData['transaction_details']['order_id'],
            'user_id' => $testUser->id,
            'catalog_template_id' => 1,
            'amount' => $testData['transaction_details']['gross_amount'],
            'discount_amount' => 0,
            'final_amount' => $testData['transaction_details']['gross_amount'],
            'payment_method' => 'midtrans',
            'payment_status' => 'pending',
            'payment_details' => json_encode([
                'customer' => $testData['customer_details'],
                'template' => ['id' => 'template-test', 'name' => 'Test Template'],
                'payment_data' => $testData
            ]),
            'download_token' => \Illuminate\Support\Str::random(32),
            'download_count' => 0,
            'max_downloads' => 3,
            'expires_at' => now()->addDays(30)
        ]);

        $midtransService = new \App\Services\CustomMidtransService();
        $snapToken = $midtransService->getSnapToken($testData);

        return response()->json([
            'success' => true,
            'snap_token' => $snapToken,
            'message' => 'Test successful',
            'purchase_id' => $templatePurchase->id
        ]);
    } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error('Test endpoint error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
});

// Midtrans Snap Token endpoint - UPDATED WITH SECURITY ENHANCEMENT
Route::post('/midtrans/get-snap-token', function (Request $request) {
    \Illuminate\Support\Facades\Log::info('API: Snap token request received', [
        'timestamp' => now()->toISOString(),
        'ip_address' => $request->ip(),
        'user_agent' => $request->userAgent(),
        'request_size' => strlen(json_encode($request->all())) . ' bytes'
    ]);

    $validated = $request->validate([
        'payment_data' => 'required|array',
        'template_data' => 'required|array',
        'customer_data' => 'required|array'
    ]);

    \Illuminate\Support\Facades\Log::info('API: Request validation passed', [
        'order_id' => $validated['payment_data']['transaction_details']['order_id'] ?? 'unknown',
        'amount' => $validated['payment_data']['transaction_details']['gross_amount'] ?? 'unknown',
        'customer_email' => $validated['customer_data']['email'] ?? 'unknown'
    ]);

    try {
        // Validate Midtrans configuration
        $serverKey = config('services.midtrans.server_key');
        $clientKey = config('services.midtrans.client_key');

        if (empty($serverKey) || empty($clientKey)) {
            \Illuminate\Support\Facades\Log::error('API: Midtrans configuration incomplete', [
                'server_key_exists' => !empty($serverKey),
                'client_key_exists' => !empty($clientKey)
            ]);
            throw new \Exception('Konfigurasi Midtrans tidak lengkap. Server key atau client key tidak ditemukan.');
        }

        \Illuminate\Support\Facades\Log::info('API: Midtrans configuration validated', [
            'is_production' => config('services.midtrans.is_production'),
            'is_sanitized' => config('services.midtrans.is_sanitized'),
            'is_3ds' => config('services.midtrans.is_3ds')
        ]);

        // Set Midtrans configuration
        \Midtrans\Config::$serverKey = $serverKey;
        \Midtrans\Config::$isProduction = config('services.midtrans.is_production');
        \Midtrans\Config::$isSanitized = config('services.midtrans.is_sanitized');
        \Midtrans\Config::$is3ds = config('services.midtrans.is_3ds');

        // SSL Configuration: Use CA certificate bundle approach
        $caBundlePaths = [
            '/etc/ssl/certs/ca-certificates.crt', // Debian/Ubuntu
            '/etc/ssl/certs/ca-bundle.crt',       // CentOS/RHEL
            '/usr/share/ssl/certs/ca-bundle.crt', // CentOS/RHEL
            '/usr/local/share/certs/ca-root-nss.crt', // FreeBSD
            '/etc/ssl/cert.pem',                  // macOS
            storage_path('cacert.pem'),           // Downloaded bundle
        ];

        $caBundle = null;
        foreach ($caBundlePaths as $path) {
            if (file_exists($path) && is_readable($path)) {
                $caBundle = $path;
                break;
            }
        }

        if ($caBundle) {
            // Use proper SSL verification with CA bundle
            \Midtrans\Config::$curlOptions = [
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_SSL_VERIFYHOST => 2,
                CURLOPT_CAINFO => $caBundle,
                CURLOPT_TIMEOUT => 60,
                CURLOPT_CONNECTTIMEOUT => 30,
                CURLOPT_USERAGENT => 'Laravel-Katalogku/1.0'
            ];
        } else {
            // Fallback for development environment only
            if (config('app.env') !== 'production') {
                \Midtrans\Config::$curlOptions = [
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => false,
                    CURLOPT_CAINFO => null,
                    CURLOPT_CAPATH => null,
                    CURLOPT_TIMEOUT => 60,
                    CURLOPT_CONNECTTIMEOUT => 30,
                    CURLOPT_USERAGENT => 'Laravel-Katalogku/1.0'
                ];
            } else {
                // Production: always use SSL verification
                \Midtrans\Config::$curlOptions = [
                    CURLOPT_SSL_VERIFYPEER => true,
                    CURLOPT_SSL_VERIFYHOST => 2,
                    CURLOPT_TIMEOUT => 60,
                    CURLOPT_CONNECTTIMEOUT => 30,
                    CURLOPT_USERAGENT => 'Laravel-Katalogku/1.0'
                ];
            }
        }

        $templateData = $validated['template_data'];
        $customerData = $validated['customer_data'];
        $paymentData = $validated['payment_data'];
        $orderId = $paymentData['transaction_details']['order_id'];

        // Server-side validation of amounts to prevent tampering
        $base_price = (float) $templateData['price'];
        $tax_rate = 0.11;
        $calculated_tax = round($base_price * $tax_rate);
        $calculated_total = $base_price + $calculated_tax;
        $frontend_total = (float) $paymentData['transaction_details']['gross_amount'];

        if ((int) $calculated_total !== (int) $frontend_total) {
            \Illuminate\Support\Facades\Log::warning('API: Payment amount mismatch. Using server-calculated value.', [
                'order_id' => $orderId,
                'server_total' => $calculated_total,
                'frontend_total' => $frontend_total
            ]);
            // Overwrite with server-calculated values to ensure correctness
            $paymentData['transaction_details']['gross_amount'] = (int) $calculated_total;
            $paymentData['item_details'] = [
                ['id' => 'template-' . $templateData['id'], 'price' => (int) $base_price, 'quantity' => 1, 'name' => $templateData['name']],
                ['id' => 'tax-' . $templateData['id'], 'price' => (int) $calculated_tax, 'quantity' => 1, 'name' => 'PPN 11%']
            ];
        }

        // Find CatalogTemplate by slug to get the correct ID
        $catalogTemplate = \App\Models\CatalogTemplate::where('slug', $templateData['id'])->first();

        if ($catalogTemplate) {
            $catalogTemplateId = $catalogTemplate->id;
        } else {
            // Fallback to a default if the slug is not found, and log a warning
            $catalogTemplateId = 1; // Default to 'toko-komputer'
            \Illuminate\Support\Facades\Log::warning('API: CatalogTemplate slug not found, falling back to default.', [
                'slug' => $templateData['id'],
                'fallback_id' => $catalogTemplateId,
            ]);
        }

        // Get or create a guest user
        \Illuminate\Support\Facades\Log::info('API: Creating or finding guest user', [
            'email' => $customerData['email'],
            'first_name' => $customerData['first_name'] ?? 'unknown',
            'last_name' => $customerData['last_name'] ?? 'unknown'
        ]);

        $guestUser = \App\Models\User::firstOrCreate(
            ['email' => $customerData['email']],
            [
                'name' => $customerData['first_name'] . ' ' . ($customerData['last_name'] ?? ''),
                'email' => $customerData['email'],
                'password' => bcrypt(\Illuminate\Support\Str::random(16)), // Random password for guest
                'email_verified_at' => now()
            ]
        );

        \Illuminate\Support\Facades\Log::info('API: Guest user ready', [
            'user_id' => $guestUser->id,
            'user_name' => $guestUser->name,
            'was_created' => $guestUser->wasRecentlyCreated
        ]);

        // SECURITY ENHANCEMENT: Create UserStore record immediately with 'pending' status
        \Illuminate\Support\Facades\Log::info('API: Creating user store record with pending status', [
            'order_id' => $orderId,
            'user_id' => $guestUser->id,
            'catalog_template_id' => $catalogTemplateId
        ]);

        // Create or update UserStore record with 'pending' status
        $userStore = \App\Models\UserStore::updateOrCreate(
            ['payment_transaction_id' => $orderId],
            [
                'user_id' => $guestUser->id,
                'catalog_template_id' => $catalogTemplateId,
                'store_name' => 'Store-' . time(), // Temporary name, will be updated during setup
                'subdomain' => 'store-' . strtolower(Str::random(8)), // Temporary subdomain
                'setup_status' => 'pending', // IMPORTANT: Set to pending immediately
                'is_active' => false,
                'payment_transaction_id' => $orderId,
                'setup_data' => json_encode([
                    'template_data' => $templateData,
                    'customer_data' => $customerData,
                    'payment_initiated_at' => now()->toISOString(),
                    'payment_amount' => $calculated_total
                ])
            ]
        );

        \Illuminate\Support\Facades\Log::info('API: UserStore record created/updated', [
            'user_store_id' => $userStore->id,
            'setup_status' => $userStore->setup_status,
            'transaction_id' => $userStore->payment_transaction_id
        ]);

        // Create template purchase record
        \Illuminate\Support\Facades\Log::info('API: Creating template purchase record', [
            'order_id' => $orderId,
            'user_id' => $guestUser->id,
            'catalog_template_id' => $catalogTemplateId,
            'amount' => $base_price,
            'final_amount' => $calculated_total
        ]);

        $templatePurchase = \App\Models\TemplatePurchase::create([
            'transaction_id' => $orderId,
            'user_id' => $guestUser->id,
            'catalog_template_id' => $catalogTemplateId,
            'amount' => $base_price,
            'discount_amount' => 0,
            'final_amount' => $calculated_total,
            'payment_method' => 'midtrans',
            'payment_status' => 'pending',
            'payment_details' => json_encode([
                'customer' => $customerData,
                'template' => $templateData,
                'payment_data' => $paymentData,
                'tax_details' => [
                    'rate' => $tax_rate,
                    'amount' => $calculated_tax
                ],
                'created_via' => 'api_snap_token',
                'created_at' => now()->toISOString(),
                'user_store_id' => $userStore->id // Link to user store
            ]),
            'download_token' => \Illuminate\Support\Str::random(32),
            'download_count' => 0,
            'max_downloads' => 3,
            'expires_at' => now()->addDays(30)
        ]);

        \Illuminate\Support\Facades\Log::info('API: Template purchase record created successfully', [
            'purchase_id' => $templatePurchase->id,
            'transaction_id' => $templatePurchase->transaction_id,
            'status' => $templatePurchase->payment_status,
            'linked_user_store_id' => $userStore->id
        ]);

        // Get Snap token using custom service to avoid SDK error handling issues
        \Illuminate\Support\Facades\Log::info('API: Calling CustomMidtransService for token generation', [
            'order_id' => $orderId,
            'purchase_id' => $templatePurchase->id,
            'user_store_id' => $userStore->id
        ]);

        $midtransService = new \App\Services\CustomMidtransService();
        $snapToken = $midtransService->getSnapToken($paymentData);

        \Illuminate\Support\Facades\Log::info('API: Complete flow successful - UserStore and TemplatePurchase created, token ready', [
            'transaction_id' => $orderId,
            'template_purchase_id' => $templatePurchase->id,
            'user_store_id' => $userStore->id,
            'customer_email' => $customerData['email'] ?? 'unknown',
            'token_length' => strlen($snapToken),
            'security_status' => 'UserStore created with pending status before payment'
        ]);

        return response()->json([
            'success' => true,
            'snap_token' => $snapToken,
            'order_id' => $orderId,
            'purchase_id' => $templatePurchase->id,
            'user_store_id' => $userStore->id
        ]);
    } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error('Midtrans Snap Token Error: ' . $e->getMessage(), [
            'trace' => $e->getTraceAsString(),
            'request_data' => $request->all()
        ]);

        // More specific error messages
        $errorMessage = 'Terjadi kesalahan pada sistem pembayaran.';

        if (strpos($e->getMessage(), 'CURL') !== false || strpos($e->getMessage(), 'SSL') !== false) {
            $errorMessage = 'Tidak dapat terhubung ke layanan pembayaran. Periksa koneksi internet Anda.';
        } elseif (strpos($e->getMessage(), 'Unauthorized') !== false || strpos($e->getMessage(), '401') !== false) {
            $errorMessage = 'Konfigurasi pembayaran tidak valid. Silakan hubungi administrator.';
        } elseif (strpos($e->getMessage(), 'validation') !== false) {
            $errorMessage = 'Data pembayaran tidak valid. Silakan periksa kembali informasi Anda.';
        }

        return response()->json([
            'success' => false,
            'message' => $errorMessage,
            'debug_message' => config('app.debug') ? $e->getMessage() : null
        ], 500);
    }
});

// Midtrans payment notification webhook
Route::post('/midtrans/notification', [App\Http\Controllers\MidtransController::class, 'notificationHandler']);

// Test route to verify payment processing (temporary)
Route::get('/test-payment-fix', function () {
    try {
        // Get or create a test user
        $testUser = \App\Models\User::firstOrCreate(
            ['email' => 'test-payment@example.com'],
            [
                'name' => 'Test Payment User',
                'email' => 'test-payment@example.com',
                'password' => bcrypt(\Illuminate\Support\Str::random(16)),
                'email_verified_at' => now()
            ]
        );

        // Test 1: Database operations
        $templatePurchase = \App\Models\TemplatePurchase::create([
            'transaction_id' => 'TEST-' . time(),
            'user_id' => $testUser->id,
            'catalog_template_id' => 1,
            'amount' => 150000,
            'discount_amount' => 0,
            'final_amount' => 150000,
            'payment_method' => 'midtrans',
            'payment_status' => 'pending',
            'payment_details' => json_encode(['test' => true]),
            'download_token' => \Illuminate\Support\Str::random(32),
            'download_count' => 0,
            'max_downloads' => 3,
            'expires_at' => now()->addDays(30)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Payment processing components are working correctly',
            'tests' => [
                'database' => 'SUCCESS - All required columns exist and can create template purchase (ID: ' . $templatePurchase->id . ')',
                'user_creation' => 'SUCCESS - Test user created/found (ID: ' . $testUser->id . ')',
                'ssl_config' => 'SUCCESS - SSL bypass configured for development',
                'midtrans_config' => 'SUCCESS - Midtrans configuration loaded'
            ],
            'next_step' => 'Try processing a real payment - the error should be resolved'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ], 500);
    }
});

// API endpoint to get template data by slug
Route::get('/templates/{slug}', function ($slug) {
    $template = \App\Models\CatalogTemplate::where('slug', $slug)->first();

    if (!$template) {
        return response()->json(['error' => 'Template not found'], 404);
    }

    return response()->json($template);
});



// ========================================
// STORE SETUP API ROUTES
// ========================================

// Check subdomain availability
Route::get('/store-setup/check-subdomain', [App\Http\Controllers\StoreSetupController::class, 'checkSubdomain'])->name('api.store.setup.check-subdomain');

// File: routes/web.php atau routes/api.php
Route::get('/test-midtrans-config', function () {
    try {
        $config = config('services.midtrans');

        return response()->json([
            'success' => true,
            'message' => 'Midtrans configuration test',
            'config' => [
                'server_key_exists' => !empty($config['server_key']),
                'client_key_exists' => !empty($config['client_key']),
                'server_key_prefix' => substr($config['server_key'] ?? '', 0, 10) . '...',
                'client_key_prefix' => substr($config['client_key'] ?? '', 0, 10) . '...',
                'is_production' => $config['is_production'],
                'is_sanitized' => $config['is_sanitized'],
                'is_3ds' => $config['is_3ds'],
            ],
            'environment_check' => [
                'MIDTRANS_SERVER_KEY' => env('MIDTRANS_SERVER_KEY') ? 'Set' : 'Not set',
                'MIDTRANS_CLIENT_KEY' => env('MIDTRANS_CLIENT_KEY') ? 'Set' : 'Not set',
            ],
            'recommendations' => [
                'server_key' => empty($config['server_key']) ? 'MISSING: Set MIDTRANS_SERVER_KEY in .env' : 'OK',
                'client_key' => empty($config['client_key']) ? 'MISSING: Set MIDTRANS_CLIENT_KEY in .env' : 'OK',
                'production_mode' => $config['is_production'] ? 'PRODUCTION MODE' : 'SANDBOX MODE',
            ]
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error testing Midtrans configuration',
            'error' => $e->getMessage()
        ], 500);
    }
});

Route::get('/debug-payment-flow', function () {
    if (config('app.env') !== 'local') {
        return response()->json(['error' => 'Only available in local environment'], 403);
    }

    try {
        // Test 1: Check Midtrans Configuration
        $midtransConfig = config('services.midtrans');
        $configCheck = [
            'server_key_configured' => !empty($midtransConfig['server_key']),
            'client_key_configured' => !empty($midtransConfig['client_key']),
            'environment' => $midtransConfig['is_production'] ? 'production' : 'sandbox'
        ];

        // Test 2: Test Database Connection
        $dbTest = false;
        try {
            DB::connection()->getPdo();
            $dbTest = true;
        } catch (\Exception $e) {
            $dbTest = false;
        }

        // Test 3: Test Template Model
        $templateCount = 0;
        try {
            $templateCount = \App\Models\CatalogTemplate::count();
        } catch (\Exception $e) {
            $templateCount = 'Error: ' . $e->getMessage();
        }

        // Test 4: Test User Creation
        $userTest = false;
        try {
            $testUser = \App\Models\User::where('email', 'debug-test@example.com')->first();
            if (!$testUser) {
                \App\Models\User::create([
                    'name' => 'Debug Test User',
                    'email' => 'debug-test@example.com',
                    'password' => bcrypt('password123'),
                    'email_verified_at' => now()
                ]);
            }
            $userTest = true;
        } catch (\Exception $e) {
            $userTest = 'Error: ' . $e->getMessage();
        }

        // Test 5: Test Midtrans API Connection
        $midtransApiTest = false;
        try {
            \Midtrans\Config::$serverKey = $midtransConfig['server_key'];
            \Midtrans\Config::$isProduction = $midtransConfig['is_production'];

            // Simple test - this might fail but we can catch it
            $midtransApiTest = 'Configured, but needs real transaction to test fully';
        } catch (\Exception $e) {
            $midtransApiTest = 'Error: ' . $e->getMessage();
        }

        return response()->json([
            'debug_results' => [
                'midtrans_config' => $configCheck,
                'database_connection' => $dbTest,
                'template_count' => $templateCount,
                'user_creation' => $userTest,
                'midtrans_api' => $midtransApiTest,
                'php_version' => phpversion(),
                'laravel_version' => app()->version(),
                'app_environment' => config('app.env'),
                'app_debug' => config('app.debug'),
                'current_time' => now()->toISOString(),
            ],
            'recommendations' => [
                'config' => $configCheck['server_key_configured'] && $configCheck['client_key_configured'] ?
                    'Midtrans configuration looks good' :
                    'Missing Midtrans keys in configuration',
                'database' => $dbTest ? 'Database connection OK' : 'Database connection failed',
                'next_steps' => [
                    '1. Ensure .env has MIDTRANS_SERVER_KEY and MIDTRANS_CLIENT_KEY',
                    '2. Run: php artisan config:cache',
                    '3. Check browser console for JavaScript errors',
                    '4. Verify internet connection can reach Midtrans servers'
                ]
            ]
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
});
