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
            'view-role',
            'create-role',
            'edit-role',
            'delete-role',
            'view-permission',
            'create-permission',
            'edit-permission',
            'delete-permission',
            'view-license',
            'create-license',
            'edit-license',
            'show-license',
            'delete-license',
            'view-company',
            'create-company',
            'edit-company',
            'delete-company',
            'view-department',
            'create-department',
            'edit-department',
            'delete-department',
            'view-device',
            'create-device',
            'edit-device',
            'delete-device',
            'view-ip',
            'create-ip',
            'edit-ip',
            'delete-ip',
            'view-patch',
            'create-patch',
            'edit-patch',
            'delete-patch',
            'view-switch',
            'create-switch',
            'edit-switch',
            'delete-switch',
            'view-schema',
            'create-schema',
            'edit-schema',
            'delete-schema',     
            'view-point',
            'create-point',
            'edit-point',
            'delete-point',        
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
