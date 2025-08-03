<?php

namespace App\Models;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = [
        'name',
        'key',
        'description',
    ];
    public function tenants()
    {
        return $this->belongsToMany(Tenant::class);
    }
}
