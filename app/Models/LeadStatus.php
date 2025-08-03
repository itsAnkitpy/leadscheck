<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class LeadStatus extends Model
{
    use HasFactory, BelongsToTenant;

    protected $fillable = [
        'name',
        'color',
        'order',
    ];
}
