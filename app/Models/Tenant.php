<?php

namespace App\Models;

use App\Models\Feature;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Illuminate\Support\Facades\Log;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    public static function boot()
    {
        parent::boot();

        static::created(function ($tenant) {
            try {
                $centralDomains = config('tenancy.central_domains');
                if (!empty($centralDomains) && isset($centralDomains[0])) {
                    $domain = $tenant->id . '.' . $centralDomains[0];
                    $tenant->domains()->create([
                        'domain' => $domain,
                    ]);
                    Log::info('Domain created for tenant: ' . $tenant->id . ' - Domain: ' . $domain);
                } else {
                    Log::error('Central domains not configured properly for tenant: ' . $tenant->id);
                }
            } catch (\Exception $e) {
                Log::error('Failed to create domain for tenant: ' . $tenant->id . ' - ' . $e->getMessage());
            }
        });
    }

    protected $fillable = [
        'id',
        'name',
        'plan',
        'status',
        'data',
        'admin_data',
    ];
    protected $casts = [
        'data' => 'array',
    ];

    public function features()
    {
        return $this->belongsToMany(Feature::class);
    }
}