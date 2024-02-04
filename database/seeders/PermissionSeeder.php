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
            'view-profile',
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
            'view-type-name',
            'create-type-name',
            'edit-type-name',
            'delete-type-name',
            'show-type-name',
            'bulk-delete-type-name',
            'import-export-type-name',
            'view-type',
            'create-type',
            'edit-type',
            'delete-type',
            'show-type',
            'bulk-delete-type',
            'import-export-type',
            'view-offer',
            'create-offer',
            'edit-offer',
            'delete-offer',
            'show-offer',
            'bulk-delete-offer',
            'import-export-offer',
            'view-order',
            'create-order',
            'attach-order',
            'delete-order',
            'show-order',
            'bulk-delete-order',
            'import-export-order',
            'view-product-order',
            'create-product-order',
            'edit-product-order',
            'delete-product-order',
            'show-product-order',
            'bulk-delete-product-order',
            'import-export-product-order',
            'view-unit',
            'create-unit',
            'edit-unit',
            'delete-unit',
            'show-unit',
            'bulk-delete-unit',
            'import-export-unit',
            'view-category',
            'create-category',
            'edit-category',
            'delete-category',
            'show-category',
            'bulk-delete-category',
            'import-export-category',
            'view-product',
            'create-product',
            'edit-product',
            'delete-product',
            'show-product',
            'bulk-delete-product',
            'import-export-product',
            'view-shopping-cart',
            'view-daily-expense',
            'create-daily-expense',
            'edit-daily-expense',
            'delete-daily-expense',
            'show-daily-expense',
            'bulk-delete-daily-expense',
            'import-export-daily-expense',
            // 'add-more-visitor',
            // 'remove-visitor'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
