<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TenantMigrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function tenant_migrations_are_run_correctly()
    {
        /** @var \App\Models\Tenant $tenant */
        $tenant = Tenant::create(['id' => 'test_tenant']);

        $tenant->run(function () {
            // Assert that tenant-specific tables exist
            $this->assertTrue(Schema::hasTable('users'));
            $this->assertTrue(Schema::hasTable('leads'));
            $this->assertTrue(Schema::hasTable('lead_statuses'));

            // Assert that central application tables do not exist
            $this->assertFalse(Schema::hasTable('tenants'));
            $this->assertFalse(Schema::hasTable('domains'));
            $this->assertFalse(Schema::hasTable('super_admins'));
        });
    }
}