<?php

namespace App\Providers;

use App\Services\FeatureService;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class FeatureServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(FeatureService::class, function () {
            return new FeatureService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Blade::if('feature', function ($key) {
            return feature_enabled($key);
        });
    }
}

if (!function_exists('feature_enabled')) {
    function feature_enabled($key)
    {
        return app(FeatureService::class)->has($key);
    }
}
