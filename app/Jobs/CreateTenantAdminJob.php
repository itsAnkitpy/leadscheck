<?php

namespace App\Jobs;

use App\Models\User;
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
            User::create([
                'name' => $this->tenant->data['admin_name'],
                'email' => $this->tenant->data['admin_email'],
                'password' => $this->tenant->data['admin_password'],
            ]);
            Log::info('Tenant admin created for tenant: ' . $this->tenant->id);
        });
    }
}
