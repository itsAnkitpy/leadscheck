<?php

namespace App\Models;

use App\Models\LeadStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Lead extends Model
{
    use HasFactory, SoftDeletes, BelongsToTenant;

    protected $fillable = [
        'lead_number',
        'spoc_contact',
        'spoc_email',
        'spoc_designation',
        'company_name',
        'company_email',
        'company_address',
        'lead_source',
        'status_id',
        'status_reason',
        'other_flavours',
        'notes',
        'tags',
        'document_path',
        'document_name',
        'created_by',
        'modified_by',
        'assigned_to_user_id',
        'data',
    ];

    protected $casts = [
        'tags' => 'json',
        'data' => 'json',
    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(LeadStatus::class, 'status_id');
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to_user_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function modifiedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'modified_by');
    }
}
