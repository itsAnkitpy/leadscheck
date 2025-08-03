<?php

namespace App\Providers;

use App\Services\FeatureService;
use Illuminate\Support\Facades\Blade;
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
        $this->app->singleton(FeatureService::class, function () {
            return new FeatureService();
        });

        Blade::if('feature', function ($key) {
            return app(FeatureService::class)->has($key);
        });
    }
}
