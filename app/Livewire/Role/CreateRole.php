<?php

namespace App\Livewire\Role;

use App\Livewire\Forms\RoleForm;
use App\Models\Permission;
use App\Traits\WithNotify;
use Livewire\Component;

class CreateRole extends Component
{
    use WithNotify;

    public RoleForm $form;

    public $create_modal = false;

    public function createModal()
    {
        $this->form->reset();
        $this->resetValidation();
        $this->create_modal = true;
    }

    public function save()
    {
        $this->form->store();
        $this->dispatch('create-role');
        $this->successNotify(__('Role created successfully'));
        $this->create_modal = false;
    }

    public function render()
    {
        $permissions = Permission::pluck('name', 'id');

        return view('livewire.role.create-role',[
            'permissions' => $permissions
        ]);
    }
}
