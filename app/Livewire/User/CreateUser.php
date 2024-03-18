<?php

namespace App\Livewire\User;

use App\Models\Role;
use App\Traits\UserTrait;
use Livewire\Component;

class CreateUser extends Component
{
    use UserTrait;

    public function createModal()
    {
        $this->reset();
        $this->resetValidation();
        $this->create_modal = true;
    }

    public function save()
    {
        $this->storeUser();
    }

    public function render()
    {
        $roles = Role::pluck('name', 'id');

        return view('livewire.user.create-user', [
            'roles' => $roles
        ]);
    }
}
