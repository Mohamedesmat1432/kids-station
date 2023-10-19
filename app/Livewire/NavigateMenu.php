<?php

namespace App\Livewire;

use Laravel\Jetstream\Http\Livewire\NavigationMenu;

class NavigateMenu extends NavigationMenu
{
    public $responsive_links = [
        [
            'name' => 'users',
            'value' => 'Users',
            'icon' => 'user',
            'role' => 'view-user'
        ],
        [
            'name' => 'roles',
            'value' => 'Roles',
            'icon' => 'lock-closed',
            'role' => 'view-role'
        ],
        [
            'name' => 'permissions',
            'value' => 'Permissions',
            'icon' => 'receipt-percent',
            'role' => 'view-permission'
        ],
        [
            'name' => 'departments',
            'value' => 'Departments',
            'icon' => 'rectangle-stack',
            'role' => 'view-department'
        ],
        [
            'name' => 'companies',
            'value' => 'Companies',
            'icon' => 'receipt-percent',
            'role' => 'home-modern'
        ],
        [
            'name' => 'licenses',
            'value' => 'Licenses',
            'icon' => 'clipboard-document-check',
            'role' => 'view-license'
        ],
        [
            'name' => 'oranges',
            'value' => 'Oranges',
            'icon' => 'clipboard-document-check',
            'role' => 'view-orange'
        ],
    ];

    public $dropdown_links = [
        [
            'name' => 'edokis',
            'value' => 'Edoki',
            'icon' => 'rectangle-stack',
            'role' => 'view-schema'
        ],
        [
            'name' => 'emad-edeens',
            'value' => 'EmadEdeen',
            'icon' => 'rectangle-stack',
            'role' => 'view-schema'
        ],
        [
            'name' => 'devices',
            'value' => 'Devices',
            'icon' => 'rectangle-stack',
            'role' => 'view-device'
        ],
        [
            'name' => 'switchs',
            'value' => 'Switchs',
            'icon' => 'rectangle-stack',
            'role' => 'view-switch'
        ],
        [
            'name' => 'patchs',
            'value' => 'Patchs',
            'icon' => 'rectangle-stack',
            'role' => 'view-patch'
        ],
        [
            'name' => 'ips',
            'value' => 'IPs',
            'icon' => 'rectangle-stack',
            'role' => 'view-ip'
        ],
        [
            'name' => 'points',
            'value' => 'Points',
            'icon' => 'rectangle-stack',
            'role' => 'view-point'
        ],
    ];

    public function render()
    {
        return view('livewire.navigate-menu');
    }
}
