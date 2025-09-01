<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TenantAssetController;
use App\Http\Controllers\Tenant\AdminController;
use App\Http\Controllers\Tenant\StoreController;
use App\Http\Controllers\Tenant\PriceRangeController;
use App\Http\Controllers\Tenant\ProductBrandController;
use App\Http\Controllers\Tenant\StoreProductController;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use App\Http\Controllers\Tenant\Admin\StoreHeroController;
use App\Http\Controllers\Tenant\ProductCategoryController;
use App\Http\Controllers\Tenant\ProductSubCategoryController;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    Route::get('/tenancy/assets/{path}', TenantAssetController::class)
        ->where('path', '.*')
        ->name('tenant.asset');
    // ========================================
    // CUSTOMER-FACING STORE ROUTES
    // ========================================


    // Route::get('/', function () {
    //     return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    // });

    // Main store page - uses template based on catalog_template_id
    Route::get('/', [StoreController::class, 'index'])->name('tenant.store.index');

    // Template-specific page
    Route::get('/template/{slug}', [StoreController::class, 'showTemplate'])->name('tenant.template.show');

    // Product routes
    Route::get('/product/{productSlug}', [StoreController::class, 'showProduct'])->name('tenant.store.product');

    // Category routes
    Route::get('/category/{categorySlug}', [StoreController::class, 'showCategory'])->name('tenant.store.category');

    // Search
    Route::get('/search', [StoreController::class, 'search'])->name('tenant.store.search');

    // API routes for AJAX
    Route::prefix('api')->name('tenant.api.')->group(function () {
        Route::get('/products', [StoreController::class, 'getProducts'])->name('products');
        Route::get('/categories', [StoreController::class, 'getCategories'])->name('categories');
    });

    // ========================================
    // TENANT ADMIN ROUTES
    // ========================================

    Route::prefix('admin')->name('tenant.admin.')->group(function () {
        // Admin Dashboard
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard.alt');

        // Store Settings
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
        Route::put('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');

        // Products Management
        Route::resource('products', StoreProductController::class)->names('products')->except(['create', 'edit']);

        // Categories Management
        Route::resource('categories', ProductCategoryController::class)->names('categories')->except(['create', 'edit']);

        // Sub-Categories Management
        Route::resource('sub-categories', ProductSubCategoryController::class)->names('sub-categories')->except(['create', 'edit']);

        // Brands Management
        Route::resource('brands', ProductBrandController::class)->names('brands')->except(['create', 'edit']);

        // Price Ranges Management
        Route::resource('price-ranges', PriceRangeController::class)->names('price-ranges')->except(['create', 'edit']);

        // Store Heroes Management
        Route::resource('store-heroes', StoreHeroController::class)->names('store-heroes');
    });
});
