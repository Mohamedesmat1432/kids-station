<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'view-user',
            'create-user',
            'edit-user',
            'delete-user',
            'show-user',
            'bulk-delete-user',
            'import-export-user',
            'view-role',
            'create-role',
            'edit-role',
            'delete-role',
            'show-role',
            'bulk-delete-role',
            'import-export-role',
            'view-permission',
            'create-permission',
            'edit-permission',
            'delete-permission',
            'show-permission',
            'bulk-delete-permission',
            'import-export-permission',
            'view-license',
            'create-license',
            'edit-license',
            'delete-license',
            'show-license',
            'bulk-delete-license',
            'import-export-license',
            'view-company',
            'create-company',
            'edit-company',
            'delete-company',
            'show-company',
            'bulk-delete-company',
            'import-export-company',
            'view-department',
            'create-department',
            'edit-department',
            'delete-department',
            'show-department',
            'bulk-delete-department',
            'import-export-department',
            'view-device',
            'create-device',
            'edit-device',
            'delete-device',
            'show-device',
            'bulk-delete-device',
            'import-export-device',
            'view-ip',
            'create-ip',
            'edit-ip',
            'delete-ip',
            'show-ip',
            'bulk-delete-ip',
            'import-export-ip',
            'view-patch',
            'create-patch',
            'edit-patch',
            'delete-patch',
            'show-patch',
            'bulk-delete-patch',
            'import-export-patch',
            'view-switch',
            'create-switch',
            'edit-switch',
            'delete-switch',
            'show-switch',
            'bulk-delete-switch',
            'import-export-switch',
            'view-schema',
            'create-schema',
            'edit-schema',
            'delete-schema',
            'show-schema',
            'bulk-delete-schema',
            'import-export-schema',
            'view-point',
            'create-point',
            'edit-point',
            'delete-point',
            'show-point',
            'bulk-delete-point',
            'import-export-point',
            'view-orange',
            'create-orange',
            'edit-orange',
            'delete-orange',
            'show-orange',
            'bulk-delete-orange',
            'import-export-orange',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
