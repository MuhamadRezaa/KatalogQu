<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View; // Add this import
use App\View\Composers\TenantSidebarComposer; // Add this import

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register the TenantSidebarComposer
        View::composer('tenant.admin.layouts.sidebar', TenantSidebarComposer::class);
    }
}
