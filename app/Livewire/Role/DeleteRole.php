<?php

namespace App\Livewire\Role;

use App\Livewire\Forms\RoleForm;
use App\Traits\WithNotify;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteRole extends Component
{
    use WithNotify;

    public RoleForm $form;

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
        $this->dispatch('delete-role');
        $this->successNotify(__('Role deleted successfully'));
        $this->delete_modal = false;
    }

    public function render()
    {
        return view('livewire.role.delete-role');
    }
}
