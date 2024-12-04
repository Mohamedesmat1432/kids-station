<?php
declare(strict_types=1);
namespace App\Livewire;

use Laravel\Jetstream\Http\Livewire\NavigationMenu;

class NavigateMenu extends NavigationMenu
{
    public function dropdwonLinks()
    {
        return [
            [
                'name' => 'profile.show',
                'value' => 'site.profile',
                'icon' => 'user',
                'role' => 'view-profile',
            ],
            [
                'name' => 'roles',
                'value' => 'site.roles',
                'icon' => 'lock-closed',
                'role' => 'view-role',
            ],
            [
                'name' => 'permissions',
                'value' => 'site.permissions',
                'icon' => 'receipt-percent',
                'role' => 'view-permission',
            ],
            [
                'name' => 'backup',
                'value' => 'site.backup',
                'icon' => 'inbox-stack',
                'role' => 'view-backup-database',
            ],
            [
                'name' => 'invoice.details',
                'value' => 'site.invoice_details',
                'icon' => 'inbox-stack',
                'role' => 'view-invoice-details',
            ],
            [
                'name' => 'categories',
                'value' => 'site.categories',
                'icon' => 'rectangle-group',
                'role' => 'view-category',
            ],
            [
                'name' => 'units',
                'value' => 'site.units',
                'icon' => 'currency-dollar',
                'role' => 'view-unit',
            ],
            [
                'name' => 'products',
                'value' => 'site.products',
                'icon' => 'clipboard-document-check',
                'role' => 'view-product',
            ],
            [
                'name' => 'type.names',
                'value' => 'site.type_names',
                'icon' => 'clipboard-document-list',
                'role' => 'view-type-name',
            ],
            [
                'name' => 'types',
                'value' => 'site.types',
                'icon' => 'adjustments-horizontal',
                'role' => 'view-type',
            ],
            [
                'name' => 'offers',
                'value' => 'site.offers',
                'icon' => 'gift',
                'role' => 'view-offer',
            ],
            [
                'name' => 'daily.expenses',
                'value' => 'site.daily_expenses',
                'icon' => 'arrow-up-right',
                'role' => 'view-daily-expense-kids',
            ],
            [
                'name' => 'money.safe',
                'value' => 'site.money_safes',
                'icon' => 'banknotes',
                'role' => 'view-money-safe-kids',
            ],
            [
                'name' => 'daily.expenses.product',
                'value' => 'site.daily_expenses_product',
                'icon' => 'arrow-up-right',
                'role' => 'view-daily-expense-product',
            ],
            [
                'name' => 'money.safe.product',
                'value' => 'site.money_safe_products',
                'icon' => 'banknotes',
                'role' => 'view-money-safe-product',
            ],
        ];
    }
    
    public function responsiveLinks()
    {
        return [
            [
                'name' => 'users',
                'value' => 'site.users',
                'icon' => 'user-group',
                'role' => 'view-user',
            ],
            [
                'name' => 'orders',
                'value' => 'site.kids_orders',
                'icon' => 'briefcase',
                'role' => 'view-order-kids',
            ],
            [
                'name' => 'shopping.cart',
                'value' => 'site.shopping_cart',
                'icon' => 'shopping-cart',
                'role' => 'view-shopping-cart',
            ],
            [
                'name' => 'product.orders',
                'value' => 'site.product_orders',
                'icon' => 'briefcase',
                'role' => 'view-product-order',
            ],
        ];
    }

    public function render()
    {
        return view('livewire.navigate-menu', [
            'dropdown_links' => $this->dropdwonLinks(),
            'responsive_links' => $this->responsiveLinks(),
        ]);
    }
}
