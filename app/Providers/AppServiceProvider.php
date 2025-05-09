<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\SecurityScannerService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(SecurityScannerService::class, function ($app) {
            return new SecurityScannerService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
