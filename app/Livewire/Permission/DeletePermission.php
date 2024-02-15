<?php

namespace App\Livewire\Permission;

use App\Traits\PermissionTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class DeletePermission extends Component
{
    use PermissionTrait;

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
        $this->authorize('delete-permission');
        $this->deletePermission($this->id);
        $this->dispatch('refresh-list-permission');
        $this->successNotify(__('site.permission_deleted'));
        $this->delete_modal = false;
    }

    public function render()
    {
        return view('livewire.permission.delete-permission');
    }
}
