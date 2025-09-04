<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;

/*
|--------------------------------------------------------------------------
| Checkout Routes
|--------------------------------------------------------------------------
|
| Here are the checkout routes for the application.
|
*/

// Public checkout routes
//Route::get('/checkout/template/{slug}', [CheckoutController::class, 'showTemplate'])->name('checkout.template');
Route::get('/checkout/template/{slug}', [CheckoutController::class, 'showTemplate'])->name('checkout.template')->middleware('auth');
// Route::post('/checkout/template/process', [CheckoutController::class, 'processTemplate'])->name('checkout.template.process');

// Public checkout routes
Route::get('/checkout/success', [CheckoutController::class, 'showSuccess'])->name('checkout.success');

// Payment status/receipt page
Route::get('/checkout/status/{order_id}', [CheckoutController::class, 'showPaymentStatus'])->name('checkout.status');


// Demo payment simulation routes (public for testing)
Route::post('/simulate-payment', [CheckoutController::class, 'simulatePaymentSuccess'])->name('checkout.simulate.payment');

// Test routes
Route::get('/test-checkout', function () {
    return 'Test checkout route works!';
})->name('test.checkout');

Route::post('/test-post', function () {
    return response()->json(['message' => 'Test POST route works!']);
})->name('test.post');
