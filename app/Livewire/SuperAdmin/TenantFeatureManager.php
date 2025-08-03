<?php

namespace App\Livewire\SuperAdmin;

use App\Models\Feature;
use App\Models\Tenant;
use Livewire\Component;

class TenantFeatureManager extends Component
{
    public Tenant $tenant;
    public $allFeatures;
    public $selectedFeatures = [];

    public function mount(Tenant $tenant)
    {
        $this->tenant = $tenant;
        $this->allFeatures = Feature::all();
        $this->selectedFeatures = $this->tenant->features->pluck('id')->toArray();
    }

    public function saveFeatures()
    {
        $this->tenant->features()->sync($this->selectedFeatures);
        
        session()->flash('message', 'Features updated successfully.');
    }

    public function render()
    {
        return view('livewire.super-admin.tenant-feature-manager');
    }
}
