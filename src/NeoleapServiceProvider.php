<?php

namespace Cofa\NeoleapIntegrationPackage;

use Illuminate\Support\ServiceProvider;

class NeoleapServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/neoleap.php' => config_path('neoleap.php'),
            ], 'neoleap-config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/neoleap.php', 'neoleap');

        // Register the main class to use with the facade
        $this->app->singleton('neoleap', function () {
            return new Services\Checkout;
        });
    }
}
