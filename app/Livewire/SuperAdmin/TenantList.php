<?php

namespace App\Livewire\SuperAdmin;

use App\Models\Tenant;
use Livewire\Component;

class TenantList extends Component
{
    public function toggleStatus($tenantId)
    {
        $tenant = Tenant::find($tenantId);
        if ($tenant) {
            $tenant->status = $tenant->status === 'active' ? 'suspended' : 'active';
            $tenant->save();
        }
    }

    public function render()
    {
        $tenants = Tenant::with('domains')->get();
        
        return view('livewire.super-admin.tenant-list', [
            'tenants' => $tenants,
        ]);
    }
}
