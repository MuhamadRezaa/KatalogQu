<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoAdminController;

// Simple test route
Route::get('/test-simple', function () {
    return 'SIMPLE TEST ROUTE WORKS!';
});

// Demo admin routes
// Test route first
Route::get('/admin/demo/test', function() {
    return 'Test route works!';
});

Route::get('/admin/demo/dashboard', [DemoAdminController::class, 'dashboard'])->name('admin.demo.dashboard');
Route::get('/api/admin/demo/purchases', [DemoAdminController::class, 'getPurchasedCatalogs'])->name('api.admin.demo.purchases');
Route::get('/api/admin/demo/purchases/{id}', [DemoAdminController::class, 'getPurchaseDetails'])->name('api.admin.demo.purchase.details');
Route::put('/api/admin/demo/purchases/{id}/status', [DemoAdminController::class, 'updatePurchaseStatus'])->name('api.admin.demo.purchase.status');
Route::get('/admin/demo/download-template/{id}', [DemoAdminController::class, 'downloadTemplate']);
Route::post('/admin/demo/send-template/{id}', [DemoAdminController::class, 'sendTemplate']);