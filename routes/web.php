<?php

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\StoreSetupController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\StoreCategoryController;
use App\Http\Controllers\CatalogTemplateController;
use App\Http\Controllers\MenuController; // New import
use Stancl\Tenancy\Middleware\InitializeTenancyByPath;
use App\Http\Controllers\StoreCategoryMenuController; // New import

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Central routes as per Laravel Tenancy documentation
foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {

        // ========================================
        // TENANT ASSET ROUTE (MANUAL OVERRIDE)
        // ========================================
        Route::get('/tenancy/{tenant}/assets/{path}', \App\Http\Controllers\TenantAssetController::class)
            ->middleware([InitializeTenancyByPath::class])
            ->where('path', '.*')
            ->name('tenant.asset.path');

        // ========================================
        // PUBLIC ROUTES (Landing Page)
        // ========================================

        Route::get('/', [LandingPageController::class, 'index'])->name('home');
        Route::get('/dashboard', function () {
            return redirect()->route('home');
        });
        Route::get('/welcome', [LandingPageController::class, 'index'])->name('welcome');

        // RUTE BARU UNTUK HALAMAN KONTAK
        Route::get('/contact', [LandingPageController::class, 'contact'])->name('contact');


        // ========================================
        // DEMO ROUTES
        // ========================================

        Route::get('/demo/{slug}', [DemoController::class, 'show'])->name('demo.show');

        // ========================================
        // MIDTRANS NOTIFICATION ROUTES
        // ========================================

        Route::post('/midtrans/notification', [MidtransController::class, 'notificationHandler']);
        Route::post('/midtrans/test', [MidtransController::class, 'test']);

        // ========================================
        // TESTING ROUTES (Development Only)
        // ========================================

        Route::get('/test/payment-success', function () {
            // Simulate successful payment for testing
            return view('pages.checkout.success', [
                'payment_status' => 'paid',
                'order_id' => 'TEST-' . time(),
                'template_name' => 'Template Toko Komputer',
                'total_amount' => 'Rp 150.000',
                'purchase_data' => null // For testing without actual purchase data
            ]);
        })->name('test.payment.success');

        Route::get('/test/payment-pending', function () {
            return view('pages.checkout.success', [
                'payment_status' => 'pending',
                'order_id' => 'TEST-' . time(),
                'template_name' => 'Template Toko Komputer',
                'total_amount' => 'Rp 150.000',
                'purchase_data' => null
            ]);
        })->name('test.payment.pending');

        Route::get('/test/payment-failed', function () {
            return view('pages.checkout.success', [
                'payment_status' => 'failed',
                'order_id' => 'TEST-' . time(),
                'template_name' => 'Template Toko Komputer',
                'total_amount' => 'Rp 150.000',
                'purchase_data' => null
            ]);
        })->name('test.payment.failed');

        // ========================================
        // AUTHENTICATION ROUTES
        // ========================================

        Route::middleware('guest')->group(function () {
            // Registration Routes
            Route::get('register', [AuthController::class, 'create'])->name('register');
            Route::post('register', [AuthController::class, 'store'])->name('register.post');

            // Login Routes
            Route::get('login', [AuthController::class, 'login'])->name('login');
            Route::post('login', [AuthController::class, 'attempt'])->name('login.post');

            // Password Reset Routes
            Route::get('forgot-password', [PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
            Route::post('forgot-password', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
            Route::get('reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
            Route::post('reset-password', [PasswordResetController::class, 'reset'])->name('password.update');
        });

        Route::post('logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');


        // Google OAuth routes
        Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
        Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

        // Route baru untuk menampilkan halaman konfirmasi registrasi Google
        Route::get('/auth/google/register', [GoogleController::class, 'showGoogleRegisterView'])->name('google.register.view');

        // Route yang ada untuk memproses pendaftaran
        Route::post('/auth/google/register', [GoogleController::class, 'handleGoogleRegister'])->name('google.register');


        // ========================================
        // AUTHENTICATED USER ROUTES
        // ========================================

        // Contact Us
        // Rute untuk menampilkan halaman kontak
        Route::get('/contact', [LandingPageController::class, 'contact'])->name('contact');

        // Rute untuk memproses pengiriman form kontak
        Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

        Route::middleware(['auth'])->group(function () {

            // Profile Routes
            Route::get('/profile', [UserProfileController::class, 'show'])->name('profile.show');
            Route::put('/profile', [UserProfileController::class, 'update'])->name('profile.update');
            Route::get('/profile/invoice/{transactionId}', [UserProfileController::class, 'showInvoice'])->name('profile.invoice.show');

            // ========================================
            // PAYMENT ROUTES
            // ========================================

            // Create payment transaction
            Route::post('/payment/create', function (Request $request) {
                // Create payment logic
                return response()->json(['success' => true, 'payment_url' => 'https://app.sandbox.midtrans.com/snap/v1/transactions/...']);
            })->name('payment.create');

            // Midtrans payment callback
            Route::post('/payment/callback', function (Request $request) {
                // Handle payment callback from Midtrans
                return response()->json(['success' => true]);
            })->name('payment.callback');

            // Payment success page
            Route::get('/payment/success', function () {
                return view('payment.checkout.success');
            })->name('payment.success');

            // Payment failed page
            Route::get('/payment/failed', function () {
                return view('payment.failed');
            })->name('payment.failed');

            // Payment pending page
            Route::get('/payment/pending', function () {
                return view('payment.pending');
            })->name('payment.pending');

            // Route to handle payment cancellation
            Route::post('/checkout/cancel', [\App\Http\Controllers\CheckoutController::class, 'cancelPayment'])->name('checkout.cancel');

            // ========================================
            // STORE SETUP ROUTES (POST-PAYMENT)
            // ========================================

            // Store setup form after payment
            Route::get('/store-setup', [StoreSetupController::class, 'showForm'])->name('store.setup.form');
            Route::post('/store-setup/process', [StoreSetupController::class, 'processForm'])->name('store.setup.process');
            Route::get('/api/store-setup/check-subdomain', [StoreSetupController::class, 'checkSubdomain'])->name('store.setup.check-subdomain');
            // HALAMAN BARU: Tampilkan halaman validasi pending
            Route::get('/store-setup/pending', [StoreSetupController::class, 'showPendingValidation'])->name('store.setup.pending');
        });

        // ========================================
        // ADMIN ROUTES
        // ========================================

        Route::prefix('admin')->middleware(['auth'])->group(function () {
            Route::get('/', function () {
                return redirect()->route('admin-main.index');
            });

            Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin-main.index');

            Route::resource('/kategori-toko', \App\Http\Controllers\StoreCategoryController::class)->names('kategori-toko');
            Route::resource('/template-katalog', \App\Http\Controllers\CatalogTemplateController::class)->names('template');

            // New route for Menu management
            Route::resource('/menus', \App\Http\Controllers\MenuController::class)->names('menu');

            // New route for Store Category Menu management
            Route::resource('/store-category-menus', \App\Http\Controllers\StoreCategoryMenuController::class)->only(['index', 'update'])->names('store-category-menus');

            Route::resource('/users', \App\Http\Controllers\UserController::class);
            Route::post('/users/{id}/restore', [\App\Http\Controllers\UserController::class, 'restore'])->name('users.restore');
            Route::delete('/users/{id}/force-delete', [\App\Http\Controllers\UserController::class, 'forceDelete'])->name('users.force-delete');

            // Payment History
            Route::get('/pembayaran', [\App\Http\Controllers\PaymentController::class, 'index'])->name('payments.index');

            // Store Management
            Route::get('/toko', [\App\Http\Controllers\ManajemenTokoController::class, 'index'])->name('toko.index');
            Route::post('/toko/{userStore}/toggle-status', [\App\Http\Controllers\ManajemenTokoController::class, 'toggleStatus'])->name('toko.toggle-status');

            // ## BARIS BARU UNTUK APPROVE TOKO ##: Route untuk admin menyetujui (approve) toko yang pending
            Route::post('/toko/{userStore}/approve', [\App\Http\Controllers\ManajemenTokoController::class, 'approve'])->name('toko.approve');
        });

        // ========================================
        // TENANT ADMIN STORE ROUTES
        // ========================================

        Route::prefix('kelola-toko/{tenant}')
            ->middleware([
                'auth',
                //InitializeTenancyByPath::class,
            ])
            ->name('tenant.admin.')
            ->group(function () {
                // Admin Dashboard
                Route::get('/', [\App\Http\Controllers\Tenant\AdminController::class, 'dashboard']);
                Route::get('/dashboard', [\App\Http\Controllers\Tenant\AdminController::class, 'dashboard'])->name('dashboard');

                // Store Settings
                Route::get('/settings', [\App\Http\Controllers\Tenant\AdminController::class, 'settings'])->name('settings');
                Route::put('/settings', [\App\Http\Controllers\Tenant\AdminController::class, 'updateSettings'])->name('settings.update');

                // Categories Management
                Route::resource('categories', \App\Http\Controllers\Tenant\ProductCategoryController::class)->names('categories')->except(['create', 'edit']);

                // Sub-Categories Management
                Route::resource('sub-categories', \App\Http\Controllers\Tenant\ProductSubCategoryController::class)->names('sub-categories')->except(['create', 'edit']);

                // Brands Management
                Route::resource('brands', \App\Http\Controllers\Tenant\ProductBrandController::class)->names('brands')->except(['create', 'edit']);

                // Product Units Management
                Route::resource('product-units', \App\Http\Controllers\Tenant\ProductUnitController::class)->names('product-units');

                // Products Management
                Route::resource('products', \App\Http\Controllers\Tenant\StoreProductController::class)->names('products')->except(['create', 'edit']);

                // Price Ranges Management
                Route::resource('price-ranges', \App\Http\Controllers\Tenant\PriceRangeController::class)->names('price-ranges')->except(['create', 'edit']);

                // Store Heroes Management
                Route::resource('store-heroes', \App\Http\Controllers\Tenant\Admin\StoreHeroController::class)->names('store-heroes');
            });

        // ========================================
        // FALLBACK ROUTE
        // ========================================

        // 404 fallback
        Route::fallback(function () {
            return view('errors.404');
        });
    }); // End central domain group
}
