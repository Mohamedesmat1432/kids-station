<?php

namespace App\Livewire\Permission;

use App\Traits\PermissionTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ListPermission extends Component
{
    use PermissionTrait;

    #[On('refresh-list-permission')]
    public function render()
    {
        return view('livewire.permission.list-permission', [
            'permissions' => $this->permissionList(),
        ])->layout('layouts.app');

    }
}
