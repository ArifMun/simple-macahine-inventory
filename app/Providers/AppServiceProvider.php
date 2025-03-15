<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use App\Http\Middleware\AuthMiddleware;
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
        app('router')->aliasMiddleware('auth', AuthMiddleware::class);
        Paginator::useBootstrap();
    }
}
