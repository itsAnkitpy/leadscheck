<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = [
            [
                'name' => 'User Management',
                'key' => 'feature_user_management',
                'description' => 'Allow tenant admins to manage users within their organization'
            ],
            [
                'name' => 'Role Management',
                'key' => 'feature_roles',
                'description' => 'Allow tenant admins to create and manage roles and permissions'
            ],
            [
                'name' => 'Lead Management',
                'key' => 'feature_lead_management',
                'description' => 'Core lead tracking and management functionality'
            ],
            [
                'name' => 'Dynamic Lead Statuses',
                'key' => 'feature_dynamic_statuses',
                'description' => 'Allow tenant admins to customize lead statuses'
            ],
            [
                'name' => 'Dynamic Form Fields',
                'key' => 'feature_dynamic_forms',
                'description' => 'Allow tenant admins to customize lead form fields'
            ],
            [
                'name' => 'Notification Templates',
                'key' => 'feature_notification_templates',
                'description' => 'Allow tenants to create custom email and WhatsApp templates'
            ],
            [
                'name' => 'Bulk WhatsApp Messaging',
                'key' => 'feature_bulk_whatsapp',
                'description' => 'Allow tenants to send bulk WhatsApp messages to leads'
            ]
        ];

        foreach ($features as $feature) {
            Feature::firstOrCreate(
                ['key' => $feature['key']],
                $feature
            );
        }
    }
}
