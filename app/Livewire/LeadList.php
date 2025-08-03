<?php

namespace App\Livewire;

use App\Models\Lead;
use App\Models\LeadStatus;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class LeadList extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';
    public $user = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';

    public $statuses;
    public $users;

    public function mount()
    {
        $this->statuses = LeadStatus::orderBy('order')->get();
        $this->users = User::all();
    }

    public function render()
    {
        $leads = Lead::with(['status', 'assignedTo'])
            ->when($this->search, function ($query) {
                $query->where('spoc_contact', 'like', '%' . $this->search . '%')
                    ->orWhere('spoc_email', 'like', '%' . $this->search . '%')
                    ->orWhere('company_name', 'like', '%' . $this->search . '%');
            })
            ->when($this->status, function ($query) {
                $query->where('status_id', $this->status);
            })
            ->when($this->user, function ($query) {
                $query->where('assigned_to_user_id', $this->user);
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);

        return view('livewire.lead-list', [
            'leads' => $leads,
        ]);
    }

    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }
}
