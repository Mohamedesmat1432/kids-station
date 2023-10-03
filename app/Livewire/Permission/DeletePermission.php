<?php

namespace App\Livewire\Permission;

use App\Livewire\Forms\PermissionForm;
use App\Models\Permission;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class DeletePermission extends Component
{
    use WithNotify;

    public PermissionForm $form;

    public $delete_modal = false;

    #[On('delete-modal')]
    public function confirmDelete(Permission $id)
    {
        $this->form->setPermission($id);
        $this->delete_modal = true;
    }

    public function delete()
    {
        $this->form->delete();
        $this->dispatch('delete-permission');
        $this->successNotify(__('Permission deleted successfully'));
        $this->delete_modal = false;
    }

    public function render()
    {
        return view('livewire.permission.delete-permission');
    }
}
