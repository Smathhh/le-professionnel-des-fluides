<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        // Auto-sync persistent NoSQL documents & media on startup
        if (!app()->runningInConsole() || app()->runningUnitTests()) {
            \App\Services\NoSqlStore::syncToDatabase();
        }
    }
}
