<?php

namespace App\Providers;

use App\Http\Middleware\CheckRole;
use App\Http\Middleware\OnlyLogout;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app['router']->aliasMiddleware('only-logout',OnlyLogout::class);
        $this->app['router']->aliasMiddleware('check-role', CheckRole::class);
        $this->app['router']->aliasMiddleware('lang', SetLocale::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
      //
    }
}
