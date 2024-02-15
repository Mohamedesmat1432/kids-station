<?php

namespace App\Livewire\Role;

use App\Models\Permission;
use App\Traits\RoleTrait;
use Livewire\Component;

class CreateRole extends Component
{
    use RoleTrait;

    public function createModal()
    {
        $this->reset();
        $this->resetValidation();
        $this->create_modal = true;
    }

    public function save()
    {
        $this->authorize('create-role');
        $this->storeRole();
        $this->dispatch('refresh-list-role');
        $this->dispatch('refresh-navigation-menu');
        $this->successNotify(__('site.role_created'));
        $this->create_modal = false;
    }

    public function render()
    {
        $permissions = Permission::pluck('name', 'id');

        return view('livewire.role.create-role', [
            'permissions' => $permissions
        ]);
    }
}
