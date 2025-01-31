<?php

namespace App\Common\V1\Providers;

use App\Common\V1\Services\Maiexcellent\MaiexcellentMockService;
use App\Common\V1\Services\Maiexcellent\MaiexcellentService;
use Illuminate\Support\ServiceProvider;

class MaiexcellentServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('maiexcellent', function () {
            return new MaiexcellentMockService(
                username: config('services.maiexcellent.username'),
                password: config('services.maiexcellent.password'),
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
