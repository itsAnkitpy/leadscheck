<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateTestTenant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:create-test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a test tenant directly via command line';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Creating test tenant...');

        try {
            $tenantId = 'testtenant' . now()->format('His');
            
            $tenant = Tenant::create([
                'id' => $tenantId,
                'name' => 'Test Tenant',
                'plan' => 'basic',
                'status' => 'active',
                'data' => [
                    'admin_name' => 'Test Admin',
                    'admin_email' => 'admin@' . $tenantId . '.test',
                    'admin_password' => Hash::make('password'),
                ]
            ]);

            $tenant->domains()->create([
                'domain' => $tenantId . '.localhost',
            ]);

            $this->info("Tenant '{$tenantId}' created successfully.");
            $this->info("The TenantCreated event has been dispatched.");
            $this->info("Check the 'jobs' table and run the queue worker.");

        } catch (\Exception $e) {
            $this->error('An error occurred while creating the test tenant:');
            $this->error($e->getMessage());
        }
    }
}