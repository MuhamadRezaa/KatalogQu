<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\WhatsvaServiceContract;
use App\Services\WhatsvaIdService;
use App\Services\WhatsvaComService;

class WhatsvaServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(WhatsvaServiceContract::class, function ($app) {
            $config = $app->make('config');
            $defaultProvider = $config->get('whatsva.default_provider');

            switch ($defaultProvider) {
                case 'whatsva_id':
                    return $app->make(WhatsvaIdService::class);
                case 'whatsva_com':
                    return $app->make(WhatsvaComService::class);
                default:
                    throw new \InvalidArgumentException("Invalid Whatsva default provider configured: {$defaultProvider}");
            }
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
