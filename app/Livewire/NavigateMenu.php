<?php

namespace App\Livewire;

use Laravel\Jetstream\Http\Livewire\NavigationMenu;

class NavigateMenu extends NavigationMenu
{
    public $responsive_links = [
        [
            'name' => 'users',
            'value' => 'site.users',
            'icon' => 'user-group',
            'role' => 'view-user'
        ],
        [
            'name' => 'roles',
            'value' => 'site.roles',
            'icon' => 'lock-closed',
            'role' => 'view-role'
        ],
        [
            'name' => 'permissions',
            'value' => 'site.permissions',
            'icon' => 'receipt-percent',
            'role' => 'view-permission'
        ],
        [
            'name' => 'orders',
            'value' => 'site.orders',
            'icon' => 'briefcase',
            'role' => 'view-order'
        ],
        [
            'name' => 'product.orders',
            'value' => 'site.product_orders',
            'icon' => 'briefcase',
            'role' => 'view-product-order'
        ],
    ];

    public $dropdown_links = [
        [
            'name' => 'profile.show',
            'value' => 'site.profile',
            'icon' => 'user',
            'role' => 'view-profile'
        ],
        [
            'name' => 'categories',
            'value' => 'site.categories',
            'icon' => 'rectangle-group',
            'role' => 'view-category'
        ],
        [
            'name' => 'units',
            'value' => 'site.units',
            'icon' => 'currency-dollar',
            'role' => 'view-unit'
        ],
        [
            'name' => 'products',
            'value' => 'site.products',
            'icon' => 'table-cells',
            'role' => 'view-product'
        ],
        [
            'name' => 'shopping.cart',
            'value' => 'site.shopping_cart',
            'icon' => 'shopping-cart',
            'role' => 'view-shopping-cart'
        ],
        [
            'name' => 'type-names',
            'value' => 'site.type_names',
            'icon' => 'clipboard-document-list',
            'role' => 'view-type-name'
        ],
        [
            'name' => 'types',
            'value' => 'site.types',
            'icon' => 'adjustments-horizontal',
            'role' => 'view-type'
        ],
        [
            'name' => 'offers',
            'value' => 'site.offers',
            'icon' => 'gift',
            'role' => 'view-offer'
        ],
    ];

    public function render()
    {
        return view('livewire.navigate-menu');
    }
}
