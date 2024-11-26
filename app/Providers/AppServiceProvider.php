<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Product;
use App\Observers\UserObserver;
use App\Observers\ProductObserver;
use Illuminate\Support\Facades\Blade;
use App\Models\SensitiveData;
use App\Observers\LogObserver;

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

    public function boot()
    {
        // User::observe(UserObserver::class);
        // Product::observe(ProductObserver::class);
        Blade::component('layouts.app', 'layouts.app');
        Product::observe(LogObserver::class);
        SensitiveData::observe(LogObserver::class);
        User::observe(LogObserver::class);
        User::observe(UserObserver::class);

    }
}
