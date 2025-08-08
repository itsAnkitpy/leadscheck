<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            // Reset cached roles and permissions
            app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

            // create permissions (only if they don't exist)
            $permissions = [
                'create-lead',
                'edit-lead', 
                'delete-lead',
                'view-lead'
            ];

            foreach ($permissions as $permission) {
                Permission::firstOrCreate(['name' => $permission]);
            }

            // create roles (only if they don't exist)
            $adminRole = Role::firstOrCreate(['name' => 'admin']);
            $adminRole->givePermissionTo(Permission::all());

            $userRole = Role::firstOrCreate(['name' => 'user']);
            $userRole->givePermissionTo(['view-lead']);
        } catch (\Exception $e) {
            // Log the error but don't fail the entire process
            \Illuminate\Support\Facades\Log::error('Seeder error: ' . $e->getMessage());
        }
    }
}