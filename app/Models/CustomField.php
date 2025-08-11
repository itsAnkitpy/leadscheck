<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomField extends Model
{
    use HasFactory;

    protected $fillable = [
        'field_key',
        'label',
        'type',
        'options',
        'description',
        'is_required',
    ];

    protected $casts = [
        'options' => 'array',
        'is_required' => 'boolean',
    ];

    /**
     * Get the tenant form fields that use this custom field template
     */
    public function tenantFormFields()
    {
        return $this->hasMany(TenantFormField::class, 'custom_field_id');
    }
}
