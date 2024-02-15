<?php

namespace App\Livewire\Role;

use App\Traits\RoleTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteRole extends Component
{
    use RoleTrait;

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
        $this->authorize('delete-role');
        $this->deleteRole($this->id);
        $this->dispatch('refresh-list-role');
        $this->dispatch('refresh-navigation-menu');
        $this->successNotify(__('site.role_deleted'));
        $this->delete_modal = false;
    }

    public function render()
    {
        return view('livewire.role.delete-role');
    }
}
