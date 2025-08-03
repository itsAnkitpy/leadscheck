<?php

namespace App\Models;

use App\Models\Feature;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    protected $fillable = [
        'id',
        'name',
        'plan',
        'status',
        'data',
    ];
    protected $casts = [
        'data' => 'array',
    ];

    public function features()
    {
        return $this->belongsToMany(Feature::class);
    }
}