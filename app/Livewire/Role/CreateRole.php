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
        $this->storeRole();
    }

    public function render()
    {
        $permissions = Permission::pluck('name', 'id');

        return view('livewire.role.create-role', [
            'permissions' => $permissions
        ]);
    }
}
