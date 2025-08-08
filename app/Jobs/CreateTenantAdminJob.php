<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Tenant as TenantModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Stancl\Tenancy\Contracts\Tenant;


class CreateTenantAdminJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Tenant $tenant;

    /**
     * Create a new job instance.
     */
    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->tenant->run(function () {
            Log::info('Creating tenant admin for tenant: ' . $this->tenant->id);
            
            // Get the tenant data from the database (fresh)
            $tenant = TenantModel::find($this->tenant->id);
            if (!$tenant || !$tenant->admin_data) {
                Log::error('Tenant admin_data is null for tenant: ' . $this->tenant->id);
                return;
            }
            
            // Decode the JSON data
            $adminData = json_decode($tenant->admin_data, true);
            if (!$adminData || !is_array($adminData)) {
                Log::error('Failed to decode admin_data for tenant: ' . $this->tenant->id . ' - Raw data: ' . $tenant->admin_data);
                return;
            }
            
            // Check if required data exists
            if (!isset($adminData['admin_name']) || 
                !isset($adminData['admin_email']) || 
                !isset($adminData['admin_password'])) {
                Log::error('Missing admin data for tenant: ' . $this->tenant->id . ' - Data: ' . json_encode($adminData));
                return;
            }
            
            try {
                User::create([
                    'name' => $adminData['admin_name'],
                    'email' => $adminData['admin_email'],
                    'password' => $adminData['admin_password'],
                ]);
                Log::info('Tenant admin created for tenant: ' . $this->tenant->id);
            } catch (\Exception $e) {
                Log::error('Failed to create tenant admin for tenant: ' . $this->tenant->id . ' - ' . $e->getMessage());
            }
        });
    }
}
