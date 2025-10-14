<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\XenditController;

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
        'payment_method' => 'xendit',
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
        'expires_at' => now()->addYears(1),
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




// API endpoint to get template data by slug
Route::get('/templates/{slug}', function ($slug) {
    $template = \App\Models\CatalogTemplate::with(['prices', 'category'])->where('slug', $slug)->first();

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

Route::post('/xendit/create-invoice', [App\Http\Controllers\CheckoutController::class, 'createXenditInvoiceApi']);

// Xendit notification webhook
Route::post('/xendit/notification', [XenditController::class, 'notificationHandler']);
