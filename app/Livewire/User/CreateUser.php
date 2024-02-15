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
        $this->authorize('create-user');
        $this->storeUser();
        $this->dispatch('refresh-list-user');
        $this->successNotify(__('site.user_created'));
        $this->create_modal = false;
    }

    public function render()
    {
        $roles = Role::pluck('name', 'id');

        return view('livewire.user.create-user', [
            'roles' => $roles
        ]);
    }
}
