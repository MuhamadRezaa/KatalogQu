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
use App\Http\Controllers\Tenant\ProductUnitController;
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
    'tenant.active',
])->group(function () {

    Route::get('/tenancy/assets/{path}', TenantAssetController::class)
        ->where('path', '.*')
        ->name('tenant.asset.domain');

    // ========================================
    // CUSTOMER-FACING STORE ROUTES
    // ========================================

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

    // AJAX ROUTE
    Route::get('/filter-products', [StoreProductController::class, 'filterProductsAjax'])->name('products.filter.ajax');

    // API routes for AJAX
    Route::prefix('api')->name('tenant.api.')->group(function () {
        Route::get('/products', [StoreController::class, 'getProducts'])->name('products');
        Route::get('/categories', [StoreController::class, 'getCategories'])->name('categories');
        Route::get('/products/{productId}', [StoreController::class, 'getProductDetails'])->name('product.details');
    });
});
