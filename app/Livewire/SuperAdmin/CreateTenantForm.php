<?php

namespace App\Livewire\SuperAdmin;

use App\Models\Tenant;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateTenantForm extends Component
{
    public $name = '';
    public $domain = '';
    public $plan = 'basic';
    public $admin_name = '';
    public $admin_email = '';
    public $admin_password = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'domain' => 'required|string|max:255|unique:domains,domain',
        'plan' => 'required|string|in:basic,premium,enterprise',
        'admin_name' => 'required|string|max:255',
        'admin_email' => 'required|email|max:255',
        'admin_password' => 'required|string|min:8',
    ];

    public function createTenant()
    {
        $this->validate();

        $tenant = Tenant::create([
            'id' => $this->domain,
            'name' => $this->name,
            'plan' => $this->plan,
            'admin_data' => json_encode([
                'admin_name' => $this->admin_name,
                'admin_email' => $this->admin_email,
                'admin_password' => Hash::make($this->admin_password),
            ]),
        ]);

        session()->flash('message', 'Tenant created successfully. Admin user is being provisioned.');

        $this->reset();
    }

    public function render()
    {
        return view('livewire.super-admin.create-tenant-form');
    }
}
