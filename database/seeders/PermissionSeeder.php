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
            'view-dashboard',
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
            'force-delete-type-name',
            'force-bulk-delete-type-name',
            'restore-type-name',
            'view-type',
            'create-type',
            'edit-type',
            'delete-type',
            'show-type',
            'bulk-delete-type',
            'import-export-type',
            'force-delete-type',
            'force-bulk-delete-type',
            'restore-type',
            'view-offer',
            'create-offer',
            'edit-offer',
            'delete-offer',
            'show-offer',
            'bulk-delete-offer',
            'import-export-offer',
            'force-delete-offer',
            'force-bulk-delete-offer',
            'restore-offer',
            'view-order-kids',
            'create-order-kids',
            'attach-order-kids',
            'delete-order-kids',
            'show-order-kids',
            'bulk-delete-order-kids',
            'import-export-order-kids',
            'force-delete-order-kids',
            'force-bulk-delete-order-kids',
            'restore-order-kids',
            'view-product-order',
            'create-product-order',
            'edit-product-order',
            'delete-product-order',
            'show-product-order',
            'bulk-delete-product-order',
            'import-export-product-order',
            'force-delete-product-order',
            'force-bulk-delete-product-order',
            'restore-product-order',
            'view-unit',
            'create-unit',
            'edit-unit',
            'delete-unit',
            'show-unit',
            'bulk-delete-unit',
            'import-export-unit',
            'force-delete-unit',
            'force-bulk-delete-unit',
            'restore-unit',
            'view-category',
            'create-category',
            'edit-category',
            'delete-category',
            'show-category',
            'bulk-delete-category',
            'import-export-category',
            'force-delete-category',
            'force-bulk-delete-category',
            'restore-category',
            'view-product',
            'create-product',
            'edit-product',
            'delete-product',
            'show-product',
            'bulk-delete-product',
            'import-export-product',
            'force-delete-product',
            'force-bulk-delete-product',
            'restore-product',
            'view-shopping-cart',
            'view-daily-expense-kids',
            'create-daily-expense-kids',
            'edit-daily-expense-kids',
            'delete-daily-expense-kids',
            'show-daily-expense-kids',
            'bulk-delete-daily-expense-kids',
            'import-export-daily-expense-kids',
            'force-delete-daily-expense-kids',
            'force-bulk-delete-daily-expense-kids',
            'restore-daily-expense-kids',
            'view-daily-expense-product',
            'create-daily-expense-product',
            'edit-daily-expense-product',
            'delete-daily-expense-product',
            'show-daily-expense-product',
            'bulk-delete-daily-expense-product',
            'import-export-daily-expense-product',
            'force-delete-daily-expense-product',
            'force-bulk-delete-daily-expense-product',
            'restore-daily-expense-product',
            'view-money-safe-kids',
            'create-money-safe-kids',
            'edit-money-safe-kids',
            'delete-money-safe-kids',
            'show-money-safe-kids',
            'bulk-delete-money-safe-kids',
            'import-export-money-safe-kids',
            'force-delete-money-safe-kids',
            'force-bulk-delete-money-safe-kids',
            'restore-money-safe-kids',
            'view-money-safe-product',
            'create-money-safe-product',
            'edit-money-safe-product',
            'delete-money-safe-product',
            'show-money-safe-product',
            'bulk-delete-money-safe-product',
            'import-export-money-safe-product',
            'force-delete-money-safe-product',
            'force-bulk-delete-money-safe-product',
            'restore-money-safe-product',
            // 'add-more-visitor',
            // 'remove-visitor'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
