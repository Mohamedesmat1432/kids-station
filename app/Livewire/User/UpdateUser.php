<?php

namespace App\Livewire\User;

use App\Models\Role;
use App\Traits\UserTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class UpdateUser extends Component
{
    use UserTrait;

    #[On('edit-modal')]
    public function confirmEdit($id)
    {
        $this->reset();
        $this->resetValidation();
        $this->setUser($id);
        $this->edit_modal = true;
    }

    public function save()
    {
        $this->authorize('edit-user');
        $this->updateUser();
        $this->dispatch('refresh-list-user');
        $this->dispatch('refresh-navigation-menu');
        $this->successNotify(__('site.user_updated'));
        $this->edit_modal = false;
    }

    public function render()
    {
        $roles = Role::pluck('name', 'id');

        return view('livewire.user.update-user', [
            'roles' => $roles
        ]);
    }
}
