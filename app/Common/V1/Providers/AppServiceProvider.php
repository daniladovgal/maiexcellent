<?php

namespace App\Common\V1\Providers;

use App\Common\V1\Pagination\CursorPaginator;
use Illuminate\Pagination\CursorPaginator as BaseCursorPaginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BaseCursorPaginator::class, CursorPaginator::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.force_https')) {
            URL::forceScheme('https');
        }
    }
}
