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
        $this->updatePermission();
    }

    public function render()
    {
        return view('livewire.permission.update-permission');
    }
}
