<?php

namespace App\Livewire\Permission;

use App\Traits\PermissionTrait;
use Livewire\Component;

class CreatePermission extends Component
{
    use PermissionTrait;

    public function createModal()
    {
        $this->reset();
        $this->resetValidation();
        $this->create_modal = true;
    }

    public function save()
    {
        $this->storePermission();
    }

    public function render()
    {
        return view('livewire.permission.create-permission');
    }
}
