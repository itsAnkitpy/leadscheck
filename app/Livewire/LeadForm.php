<?php

namespace App\Livewire;

use App\Models\Lead;
use App\Models\LeadStatus;
use App\Models\TenantFormField;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LeadForm extends Component
{
    public ?Lead $lead = null;

    public $lead_number;
    public $spoc_contact;
    public $spoc_email;
    public $spoc_designation;
    public $company_name;
    public $company_email;
    public $company_address;
    public $lead_source;
    public $status_id;
    public $status_reason;
    public $other_flavours;
    public $notes;
    public $tags = [];
    public $document_path;
    public $document_name;
    public $assigned_to_user_id;
    public $data = [];

    public $statuses;
    public $users;
    public $dynamicFields = []; // To be implemented in Task 4

    public function mount(Lead $lead = null)
    {
        $this->lead = $lead;
        $this->statuses = LeadStatus::orderBy('order')->get();
        $this->users = User::all();

        if ($this->lead) {
            $this->lead_number = $this->lead->lead_number;
            $this->spoc_contact = $this->lead->spoc_contact;
            $this->spoc_email = $this->lead->spoc_email;
            $this->spoc_designation = $this->lead->spoc_designation;
            $this->company_name = $this->lead->company_name;
            $this->company_email = $this->lead->company_email;
            $this->company_address = $this->lead->company_address;
            $this->lead_source = $this->lead->lead_source;
            $this->status_id = $this->lead->status_id;
            $this->status_reason = $this->lead->status_reason;
            $this->other_flavours = $this->lead->other_flavours;
            $this->notes = $this->lead->notes;
            $this->tags = $this->lead->tags ?? [];
            $this->document_path = $this->lead->document_path;
            $this->document_name = $this->lead->document_name;
            $this->assigned_to_user_id = $this->lead->assigned_to_user_id;
            $this->data = $this->lead->data ?? [];
        }

        // In Task 4, we will fetch the dynamic form configuration for the tenant
        // For now, we will use a placeholder
        $this->dynamicFields = TenantFormField::where('is_enabled', true)->orderBy('order')->get();
    }

    public function save()
    {
        $this->validate([
            'spoc_contact' => 'required|string|max:255',
            'spoc_email' => 'required|email|max:255',
            'status_id' => 'required|exists:lead_statuses,id',
            'assigned_to_user_id' => 'nullable|exists:users,id',
        ]);

        $leadData = [
            'spoc_contact' => $this->spoc_contact,
            'spoc_email' => $this->spoc_email,
            'spoc_designation' => $this->spoc_designation,
            'company_name' => $this->company_name,
            'company_email' => $this->company_email,
            'company_address' => $this->company_address,
            'lead_source' => $this->lead_source,
            'status_id' => $this->status_id,
            'status_reason' => $this->status_reason,
            'other_flavours' => $this->other_flavours,
            'notes' => $this->notes,
            'tags' => $this->tags,
            'document_path' => $this->document_path,
            'document_name' => $this->document_name,
            'assigned_to_user_id' => $this->assigned_to_user_id,
            'data' => $this->data,
        ];

        if ($this->lead) {
            $leadData['modified_by'] = Auth::id();
            $this->lead->update($leadData);
        } else {
            $leadData['created_by'] = Auth::id();
            $leadData['lead_number'] = 'LEAD-' . time(); // Simple lead number generation
            Lead::create($leadData);
        }

        return redirect()->route('leads.index');
    }

    public function render()
    {
        return view('livewire.lead-form');
    }
}
