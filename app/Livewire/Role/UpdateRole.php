<?php

namespace App\Livewire\Role;

use App\Livewire\Forms\RoleForm;
use App\Models\Permission;
use App\Models\Role;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class UpdateRole extends Component
{
    use WithNotify;

    public RoleForm $form;

    public $edit_modal = false;

    #[On('edit-modal')]
    public function confirmEdit(Role $id)
    {
        $this->form->reset();
        $this->resetValidation();
        $this->form->setRole($id);
        $this->edit_modal = true;
    }

    public function save()
    {
        $this->form->update();
        $this->dispatch('update-role');
        $this->successNotify(__('Role updated successfully'));
        $this->edit_modal = false;
    }

    public function render()
    {
        $permissions = Permission::pluck('name', 'id');

        return view('livewire.role.update-role',[
            'permissions' => $permissions
        ]);
    }
}
