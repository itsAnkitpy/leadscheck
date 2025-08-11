<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantFormField extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'custom_field_id',
        'field_key',
        'label',
        'type',
        'options',
        'is_enabled',
        'is_required',
        'order',
        'description',
    ];

    protected $casts = [
        'options' => 'array',
        'is_enabled' => 'boolean',
        'is_required' => 'boolean',
    ];

    /**
     * Get the tenant that owns this form field
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Get the custom field template that this field is based on
     */
    public function customField()
    {
        return $this->belongsTo(CustomField::class);
    }
}
