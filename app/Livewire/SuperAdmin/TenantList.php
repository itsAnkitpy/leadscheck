<?php

namespace App\Livewire\SuperAdmin;

use App\Models\Tenant;
use Livewire\Component;
use Livewire\WithPagination;

class TenantList extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $planFilter = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'statusFilter' => ['except' => ''],
        'planFilter' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingPlanFilter()
    {
        $this->resetPage();
    }

    public function toggleStatus($tenantId)
    {
        $tenant = Tenant::find($tenantId);
        if ($tenant) {
            $tenant->status = $tenant->status === 'active' ? 'suspended' : 'active';
            $tenant->save();
            
            session()->flash('message', 'Tenant status updated successfully.');
        }
    }

    public function render()
    {
        $tenants = Tenant::with('domains')
            ->when($this->search, function ($query) {
                $query->where('id', 'like', '%' . $this->search . '%')
                      ->orWhere('name', 'like', '%' . $this->search . '%')
                      ->orWhereHas('domains', function ($q) {
                          $q->where('domain', 'like', '%' . $this->search . '%');
                      });
            })
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->when($this->planFilter, function ($query) {
                $query->where('plan', $this->planFilter);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('livewire.super-admin.tenant-list', [
            'tenants' => $tenants,
        ]);
    }
}
