<?php

namespace App\Livewire\Permission;

use App\Traits\PermissionTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class UpdatePermission extends Component
{
    use PermissionTrait;

    #[On('edit-modal')]
    public function confirmEdit($id)
    {
        $this->reset();
        $this->resetValidation();
        $this->setPermission($id);
        $this->edit_modal = true;
    }

    public function save()
    {
        $this->authorize('edit-permission');
        $this->updatePermission();
        $this->dispatch('refresh-list-permission');
        $this->successNotify(__('site.permission_updated'));
        $this->edit_modal = false;
    }

    public function render()
    {
        return view('livewire.permission.update-permission');
    }
}
