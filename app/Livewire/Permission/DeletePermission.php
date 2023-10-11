<?php

namespace App\Livewire\Permission;

use App\Livewire\Forms\PermissionForm;
use App\Traits\WithNotify;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class DeletePermission extends Component
{
    use WithNotify;

    public PermissionForm $form;

    public $delete_modal = false;

    #[Locked]
    public $id, $name;

    #[On('delete-modal')]
    public function confirmDelete($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->delete_modal = true;
    }

    public function delete()
    {
        $this->form->delete($this->id);
        $this->dispatch('delete-permission');
        $this->successNotify(__('Permission deleted successfully'));
        $this->delete_modal = false;
    }

    public function render()
    {
        return view('livewire.permission.delete-permission');
    }
}
