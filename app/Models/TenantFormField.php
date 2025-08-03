<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantFormField extends Model
{
    use HasFactory;

    protected $fillable = [
        'field_key',
        'label',
        'is_enabled',
        'order',
    ];
}
