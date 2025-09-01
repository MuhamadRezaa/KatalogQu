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
Route::get('/checkout/template/{slug}', [CheckoutController::class, 'showTemplate'])->name('checkout.template');
// Route::post('/checkout/template/process', [CheckoutController::class, 'processTemplate'])->name('checkout.template.process');

// Public checkout routes
Route::get('/checkout/success', [CheckoutController::class, 'showSuccess'])->name('checkout.success');
Route::post('/checkout/callback', [CheckoutController::class, 'paymentCallback'])->name('checkout.callback');

// Demo payment simulation routes (public for testing)
Route::post('/simulate-payment', [CheckoutController::class, 'simulatePaymentSuccess'])->name('checkout.simulate.payment');

// Test routes
Route::get('/test-checkout', function () {
    return 'Test checkout route works!';
})->name('test.checkout');

Route::post('/test-post', function () {
    return response()->json(['message' => 'Test POST route works!']);
})->name('test.post');
