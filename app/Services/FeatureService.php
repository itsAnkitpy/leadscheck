<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class FeatureService
{
    protected $tenant;
    protected $features;

    public function __construct()
    {
        $this->tenant = tenant();
        $this->features = $this->getFeatures();
    }

    public function getFeatures()
    {
        if (!$this->tenant) {
            return collect();
        }

        return Cache::rememberForever('tenant:' . $this->tenant->id . ':features', function () {
            return $this->tenant->features()->pluck('key')->flip();
        });
    }

    public function has($key)
    {
        return $this->features->has($key);
    }
    public static function clearCache($tenantId)
    {
        Cache::forget('tenant:' . $tenantId . ':features');
    }
}