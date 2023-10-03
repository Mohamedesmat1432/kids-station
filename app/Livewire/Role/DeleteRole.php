<?php

namespace App\Livewire\Role;

use App\Livewire\Forms\RoleForm;
use App\Models\Role;
use App\Traits\WithNotify;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteRole extends Component
{
    use WithNotify;

    public RoleForm $form;

    public $delete_modal = false;

    #[On('delete-modal')]
    public function confirmDelete(Role $id)
    {
        $this->form->setRole($id);
        $this->delete_modal = true;
    }

    public function delete()
    {
        $this->form->delete();
        $this->dispatch('delete-role');
        $this->successNotify(__('Role deleted successfully'));
        $this->delete_modal = false;
    }

    public function render()
    {
        return view('livewire.role.delete-role');
    }
}
