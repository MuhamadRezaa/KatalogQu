<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Payment;
use App\Models\TemplatePurchase;
use App\Models\User;
use App\Models\CatalogTemplate;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class CheckoutController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        // Apply auth middleware only to specific methods, allow demo checkout
        $this->middleware('auth')->except(['showTemplate', 'processTemplate', 'showSuccess', 'simulatePaymentSuccess']);
    }

    /**
     * Show the checkout template page
     *
     * @param string|null $slug The template slug
     */
    public function showTemplate($slug = null)
    {
        // Tampilkan halaman maintenance untuk checkout template
        //return view('payment.checkout.checkout-maintenance', compact('slug'));
        // Pass the slug to the view if provided
        return view('payment.checkout.template', compact('slug'));
    }

    public function showSuccess(Request $request)
    {
        $orderId = $request->query('order_id');

        // Ambil data dari database berdasarkan order_id
        $templatePurchase = null;
        if ($orderId) {
            $templatePurchase = TemplatePurchase::with('catalogTemplate')
                ->where('transaction_id', $orderId)
                ->first();
        }

        // Jika data tidak ditemukan di database, gunakan fallback dari URL parameters
        if ($templatePurchase) {
            return view('payment.checkout.success', [
                'order_id' => $templatePurchase->transaction_id,
                'template_name' => $templatePurchase->catalogTemplate->name ?? 'Template',
                'total_amount' => 'Rp ' . number_format($templatePurchase->amount, 0, ',', '.'),
                'payment_status' => $templatePurchase->payment_status,
                'purchase_data' => $templatePurchase
            ]);
        } else {
            // Fallback ke URL parameters jika data tidak ditemukan
            $templateName = $request->query('template_name');
            $totalAmount = $request->query('total_amount');

            return view('payment.checkout.success', [
                'order_id' => $orderId,
                'template_name' => $templateName,
                'total_amount' => $totalAmount,
                'payment_status' => 'paid',
                'purchase_data' => null
            ]);
        }
    }

    /**
     * Simulate payment success for demo purposes
     */
    public function simulatePaymentSuccess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'full_name' => 'required|string',
            'phone' => 'required|string',
            'order_id' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed: ' . $validator->errors()->first()
            ], 400);
        }

        try {
            $orderId = $request->order_id;

            // Create demo order data if not exists in session
            $orderData = session('checkout_order');

            if (!$orderData) {
                // Create demo order data from request
                $templateData = json_decode($request->template_data, true) ?: [
                    'name' => 'TechZone Computer Store Template',
                    'type' => 'Toko Komputer',
                    'price' => 150000,
                    'features' => ['Demo features']
                ];

                $orderData = [
                    'order_id' => $orderId,
                    'customer' => [
                        'email' => $request->email,
                        'full_name' => $request->full_name,
                        'phone' => $request->phone
                    ],
                    'template' => $templateData,
                    'payment_method' => 'demo'
                ];

                // Store in session for potential future use
                session(['checkout_order' => $orderData]);
            }

            // For demo purposes, we'll skip the actual payment processing
            // and just log the demo transaction
            Log::info('Demo payment simulation', [
                'order_id' => $orderId,
                'customer' => $orderData['customer'],
                'template' => $orderData['template']
            ]);

            // Clear session data
            session()->forget('checkout_order');

            return response()->json([
                'success' => true,
                'message' => 'Demo payment berhasil! Mengalihkan ke dashboard admin...',
                'redirect_url' => route('admin.dashboard.demo')
            ]);
        } catch (\Exception $e) {
            Log::error('Payment simulation failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Demo payment simulation failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Handle successful payment
     */
    private function handlePaymentSuccess($orderData)
    {
        try {
            // Create or update user if not authenticated
            $user = null;
            if (Auth::check()) {
                $user = Auth::user();
            } else {
                // For demo purposes, create a guest user or find existing user by email
                $user = User::firstOrCreate(
                    ['email' => $orderData['customer']['email']],
                    [
                        'name' => $orderData['customer']['full_name'],
                        'phone' => $orderData['customer']['phone'],
                        'password' => bcrypt(Str::random(12)), // Random password for guest users
                        'email_verified_at' => now()
                    ]
                );
            }

            // Find default store category or create one
            $defaultCategory = \App\Models\StoreCategory::firstOrCreate(
                ['slug' => 'toko-komputer'],
                [
                    'name' => 'Toko Komputer',
                    'description' => 'Template untuk toko komputer dan elektronik',
                    'is_active' => true,
                    'sort_order' => 1
                ]
            );

            // Find or create catalog template
            $catalogTemplate = CatalogTemplate::firstOrCreate(
                ['name' => $orderData['template']['name']],
                [
                    'categories_store_id' => $defaultCategory->id,
                    'description' => 'Template: ' . $orderData['template']['name'],
                    'slug' => \Illuminate\Support\Str::slug($orderData['template']['name']),
                    'price' => $orderData['template']['price'],
                    'demo_url' => '#',
                    'preview_image' => 'default-template.jpg',
                    'is_active' => true,
                    'status' => 'active',
                    'tags' => ['template', 'komputer', 'toko']
                ]
            );

            // Create template purchase record
            $purchase = TemplatePurchase::create([
                'transaction_id' => $orderData['order_id'],
                'user_id' => $user->id,
                'catalog_template_id' => $catalogTemplate->id,
                'amount' => $orderData['template']['price'],
                'discount_amount' => 0,
                'final_amount' => $orderData['template']['price'],
                'payment_method' => $orderData['payment_method'],
                'payment_status' => 'paid',
                'payment_details' => json_encode([
                    'customer' => $orderData['customer'],
                    'template' => $orderData['template'],
                    'payment_date' => now()->toISOString()
                ]),
                'download_token' => Str::random(32),
                'download_count' => 0,
                'max_downloads' => 3,
                'expires_at' => now()->addDays(30)
            ]);

            Log::info('Payment processed successfully', [
                'order_id' => $orderData['order_id'],
                'user_id' => $user->id,
                'purchase_id' => $purchase->id
            ]);

            return $purchase;
        } catch (\Exception $e) {
            Log::error('Failed to handle payment success: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Handle payment pending
     */
    private function handlePaymentPending($orderData)
    {
        // Implementation for pending payment
        Log::info('Payment pending', ['order_id' => $orderData['order_id']]);
    }

    /**
     * Handle payment failed
     */
    private function handlePaymentFailed($orderData, $status)
    {
        // Implementation for failed payment
        Log::info('Payment failed', [
            'order_id' => $orderData['order_id'],
            'status' => $status
        ]);
    }

    /**
     * Handle payment challenge
     */
    private function handlePaymentChallenge($orderData)
    {
        // Implementation for payment challenge
        Log::info('Payment challenge', ['order_id' => $orderData['order_id']]);
    }

    /**
     * Process template checkout
     * Note: This method is no longer used as checkout now uses Midtrans Snap directly via API
     */
    // public function processTemplate(Request $request)
    // {
    //     // Validate the request
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|email|max:255',
    //         'full_name' => 'required|string|max:255',
    //         'phone' => 'required|string|max:20',
    //         'template_data' => 'required|json',
    //         'payment_method' => 'required|in:midtrans,bank_transfer,e_wallet,qris'
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     try {
    //         // Parse template data
    //         $templateData = json_decode($request->template_data, true);
    //
    //         if (!$templateData) {
    //             throw new \Exception('Invalid template data');
    //         }

    //         // Validate template data structure
    //         $templateValidator = Validator::make($templateData, [
    //             'name' => 'required|string',
    //             'type' => 'required|string',
    //             'price' => 'required|numeric|min:0',
    //             'features' => 'required|array'
    //         ]);

    //         if ($templateValidator->fails()) {
    //             throw new \Exception('Invalid template data structure');
    //         }

    //         // Generate order ID
    //         $orderId = 'TEMPLATE-' . time() . '-' . Str::random(6);
    //         $paymentMethod = $request->payment_method;

    //         // Handle different payment methods
    //         switch ($paymentMethod) {
    //             case 'midtrans':
    //                 return $this->processMidtransPayment($orderId, $templateData, $request);
    //
    //             case 'bank_transfer':
    //                 return $this->processBankTransferPayment($orderId, $templateData, $request);
    //
    //             case 'e_wallet':
    //                 return $this->processEWalletPayment($orderId, $templateData, $request);
    //
    //             case 'qris':
    //                 return $this->processQRISPayment($orderId, $templateData, $request);
    //
    //             default:
    //                 throw new \Exception('Metode pembayaran tidak didukung');
    //         }

    //     } catch (\Exception $e) {
    //         Log::error('Checkout process failed: ' . $e->getMessage());
    //
    //         return redirect()->back()
    //             ->with('error', 'Terjadi kesalahan dalam proses checkout. Silakan coba lagi.')
    //             ->withInput();
    //     }
    // }



    /**
     * Get Midtrans Snap Token
     */
    private function getMidtransSnapToken($paymentData)
    {
        // Set Midtrans configuration
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');

        try {
            $snapToken = Snap::getSnapToken($paymentData);
            return $snapToken;
        } catch (\Exception $e) {
            Log::error('Midtrans Snap Token Error: ' . $e->getMessage());
            throw new \Exception('Failed to get payment token');
        }
    }



    /**
     * Save payment record to database
     */
    private function savePaymentRecord($orderData, $status)
    {
        DB::beginTransaction();

        try {
            $templateData = $orderData['template'];
            $customerData = $orderData['customer'];
            $paymentData = $orderData['payment_data'];

            // Find or create user based on email
            $user = User::where('email', $customerData['email'])->first();
            if (!$user) {
                // Create a guest user for this purchase
                $user = User::create([
                    'name' => $customerData['full_name'],
                    'email' => $customerData['email'],
                    'password' => bcrypt(Str::random(16)),
                    'email_verified_at' => now()
                ]);
            }

            // Get catalog template ID based on template name
            $catalogTemplate = CatalogTemplate::where('name', $templateData['name'])->first();
            if (!$catalogTemplate) {
                // If template not found, create a basic one or use first available
                $catalogTemplate = CatalogTemplate::first();
                if (!$catalogTemplate) {
                    throw new \Exception('No catalog templates available');
                }
            }
            $catalogTemplateId = $catalogTemplate->id;

            // Create or update payment record
            $payment = Payment::updateOrCreate(
                ['transaction_id' => $orderData['order_id']],
                [
                    'user_id' => $user->id,
                    'catalog_template_id' => $catalogTemplateId,
                    'store_name' => $templateData['name'] ?? 'Template Store',
                    'amount' => $templateData['price'],
                    'discount_amount' => 0,
                    'final_amount' => $templateData['price'],
                    'payment_method' => 'midtrans',
                    'status' => $status,
                    'payment_details' => [
                        'template_name' => $templateData['name'],
                        'template_type' => $templateData['type'],
                        'features' => $templateData['features'] ?? [],
                        'customer_name' => $customerData['full_name'],
                        'customer_phone' => $customerData['phone'],
                        'midtrans_data' => $paymentData
                    ],
                    'paid_at' => $status === 'paid' ? now() : null,
                    'expires_at' => now()->addDays(30)
                ]
            );

            // Create or update template purchase record
            $templatePurchaseStatus = $status === 'paid' ? 'paid' : ($status === 'failed' ? 'failed' : 'pending');

            $templatePurchase = TemplatePurchase::updateOrCreate(
                ['transaction_id' => $orderData['order_id']],
                [
                    'user_id' => $user->id,
                    'catalog_template_id' => $catalogTemplateId,
                    'amount' => $templateData['price'],
                    'discount_amount' => 0,
                    'final_amount' => $templateData['price'],
                    'payment_method' => 'midtrans',
                    'payment_status' => $templatePurchaseStatus,
                    'payment_details' => [
                        'template_name' => $templateData['name'],
                        'template_type' => $templateData['type'],
                        'features' => $templateData['features'] ?? [],
                        'customer_name' => $customerData['full_name'],
                        'customer_phone' => $customerData['phone'],
                        'purchase_date' => now()->toDateString()
                    ],
                    'paid_at' => $status === 'paid' ? now() : null,
                    'download_token' => $status === 'paid' ? Str::random(32) : null,
                    'download_count' => 0,
                    'max_downloads' => 3,
                    'expires_at' => now()->addDays(30)
                ]
            );

            DB::commit();

            Log::info('Payment record saved', [
                'order_id' => $orderData['order_id'],
                'status' => $status,
                'user_id' => $user->id,
                'payment_id' => $payment->id,
                'template_purchase_id' => $templatePurchase->id
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to save payment record: ' . $e->getMessage(), [
                'order_id' => $orderData['order_id'],
                'status' => $status,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    /**
     * Process Midtrans payment
     */
    private function processMidtransPayment($orderId, $templateData, $request)
    {
        // Prepare payment data for Midtrans
        $paymentData = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $templateData['price']
            ],
            'customer_details' => [
                'first_name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone
            ],
            'item_details' => [[
                'id' => 'template-' . strtolower(str_replace(' ', '-', $templateData['type'])),
                'price' => (int) $templateData['price'],
                'quantity' => 1,
                'name' => $templateData['name']
            ]]
        ];

        // Get Midtrans Snap Token
        $snapToken = $this->getMidtransSnapToken($paymentData);

        if (!$snapToken) {
            throw new \Exception('Failed to generate payment token');
        }

        // Store order data in session for later processing
        session([
            'checkout_order' => [
                'order_id' => $orderId,
                'customer' => [
                    'email' => $request->email,
                    'full_name' => $request->full_name,
                    'phone' => $request->phone
                ],
                'template' => $templateData,
                'payment_data' => $paymentData,
                'payment_method' => 'midtrans'
            ]
        ]);

        return response()->json([
            'success' => true,
            'payment_type' => 'midtrans',
            'snap_token' => $snapToken,
            'order_id' => $orderId
        ]);
    }

    /**
     * Process Bank Transfer payment
     */
    private function processBankTransferPayment($orderId, $templateData, $request)
    {
        // Bank account details
        $bankAccounts = [
            'bca' => [
                'bank_name' => 'Bank Central Asia (BCA)',
                'account_number' => '1234567890',
                'account_name' => 'PT KatalogKu Indonesia'
            ],
            'mandiri' => [
                'bank_name' => 'Bank Mandiri',
                'account_number' => '0987654321',
                'account_name' => 'PT KatalogKu Indonesia'
            ],
            'bni' => [
                'bank_name' => 'Bank Negara Indonesia (BNI)',
                'account_number' => '1122334455',
                'account_name' => 'PT KatalogKu Indonesia'
            ],
            'bri' => [
                'bank_name' => 'Bank Rakyat Indonesia (BRI)',
                'account_number' => '5544332211',
                'account_name' => 'PT KatalogKu Indonesia'
            ]
        ];

        // Store order data in session
        session([
            'checkout_order' => [
                'order_id' => $orderId,
                'customer' => [
                    'email' => $request->email,
                    'full_name' => $request->full_name,
                    'phone' => $request->phone
                ],
                'template' => $templateData,
                'payment_method' => 'bank_transfer',
                'bank_accounts' => $bankAccounts,
                'expires_at' => now()->addHours(24)->format('Y-m-d H:i:s')
            ]
        ]);

        return response()->json([
            'success' => true,
            'payment_type' => 'bank_transfer',
            'order_id' => $orderId,
            'bank_accounts' => $bankAccounts,
            'amount' => (int) $templateData['price'],
            'expires_at' => now()->addHours(24)->format('Y-m-d H:i:s'),
            'instructions' => 'Silakan transfer ke salah satu rekening di atas dengan nominal yang tepat. Pembayaran akan dikonfirmasi dalam 1x24 jam.'
        ]);
    }

    /**
     * Process E-Wallet payment
     */
    private function processEWalletPayment($orderId, $templateData, $request)
    {
        // E-Wallet options
        $eWalletOptions = [
            'gopay' => [
                'name' => 'GoPay',
                'phone' => '081234567890',
                'qr_code' => 'data:image/svg+xml;base64,' . base64_encode('<svg>QR Code for GoPay</svg>')
            ],
            'ovo' => [
                'name' => 'OVO',
                'phone' => '081234567890',
                'qr_code' => 'data:image/svg+xml;base64,' . base64_encode('<svg>QR Code for OVO</svg>')
            ],
            'dana' => [
                'name' => 'DANA',
                'phone' => '081234567890',
                'qr_code' => 'data:image/svg+xml;base64,' . base64_encode('<svg>QR Code for DANA</svg>')
            ],
            'shopeepay' => [
                'name' => 'ShopeePay',
                'phone' => '081234567890',
                'qr_code' => 'data:image/svg+xml;base64,' . base64_encode('<svg>QR Code for ShopeePay</svg>')
            ]
        ];

        // Store order data in session
        session([
            'checkout_order' => [
                'order_id' => $orderId,
                'customer' => [
                    'email' => $request->email,
                    'full_name' => $request->full_name,
                    'phone' => $request->phone
                ],
                'template' => $templateData,
                'payment_method' => 'e_wallet',
                'e_wallet_options' => $eWalletOptions,
                'expires_at' => now()->addMinutes(15)->format('Y-m-d H:i:s')
            ]
        ]);

        return response()->json([
            'success' => true,
            'payment_type' => 'e_wallet',
            'order_id' => $orderId,
            'e_wallet_options' => $eWalletOptions,
            'amount' => (int) $templateData['price'],
            'expires_at' => now()->addMinutes(15)->format('Y-m-d H:i:s'),
            'instructions' => 'Pilih salah satu e-wallet dan lakukan pembayaran sesuai nominal yang tertera.'
        ]);
    }

    /**
     * Process QRIS payment
     */
    private function processQRISPayment($orderId, $templateData, $request)
    {
        // Generate QRIS code (in real implementation, this would be from payment gateway)
        $qrisData = [
            'qr_code' => 'data:image/svg+xml;base64,' . base64_encode(
                '<svg width="200" height="200" xmlns="http://www.w3.org/2000/svg">' .
                    '<rect width="200" height="200" fill="white"/>' .
                    '<text x="100" y="100" text-anchor="middle" font-family="Arial" font-size="12">QRIS Code</text>' .
                    '<text x="100" y="120" text-anchor="middle" font-family="Arial" font-size="10">' . $orderId . '</text>' .
                    '</svg>'
            ),
            'merchant_name' => 'KatalogKu Indonesia',
            'merchant_city' => 'Jakarta'
        ];

        // Store order data in session
        session([
            'checkout_order' => [
                'order_id' => $orderId,
                'customer' => [
                    'email' => $request->email,
                    'full_name' => $request->full_name,
                    'phone' => $request->phone
                ],
                'template' => $templateData,
                'payment_method' => 'qris',
                'qris_data' => $qrisData,
                'expires_at' => now()->addMinutes(15)->format('Y-m-d H:i:s')
            ]
        ]);

        return response()->json([
            'success' => true,
            'payment_type' => 'qris',
            'order_id' => $orderId,
            'qris_data' => $qrisData,
            'amount' => (int) $templateData['price'],
            'expires_at' => now()->addMinutes(15)->format('Y-m-d H:i:s'),
            'instructions' => 'Scan QR Code di atas menggunakan aplikasi mobile banking atau e-wallet yang mendukung QRIS.'
        ]);
    }
}
