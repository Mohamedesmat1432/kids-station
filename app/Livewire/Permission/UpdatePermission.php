<?php

namespace App\Livewire\Permission;

use App\Livewire\Forms\PermissionForm;
use App\Models\Permission;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class UpdatePermission extends Component
{
    use WithNotify;

    public PermissionForm $form;

    public $edit_modal = false;

    #[On('edit-modal')]
    public function confirmEdit(Permission $id)
    {
        $this->form->reset();
        $this->resetValidation();
        $this->form->setPermission($id);
        $this->edit_modal = true;
    }

    public function save()
    {
        $this->form->update();
        $this->dispatch('update-permission');
        $this->successNotify(__('Permission updated successfully'));
        $this->edit_modal = false;
    }

    public function render()
    {
        return view('livewire.permission.update-permission');
    }
}
