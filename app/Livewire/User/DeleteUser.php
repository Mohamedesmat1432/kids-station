<?php

namespace App\Livewire\User;

use App\Traits\UserTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteUser extends Component
{
    use UserTrait;

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
        $this->authorize('delete-user');
        $this->deleteUser($this->id);
        $this->dispatch('refresh-list-user');
        $this->dispatch('refresh-navigation-menu');
        $this->successNotify(__('User deleted successfully'));
        $this->delete_modal = false;
    }

    public function render()
    {
        return view('livewire.user.delete-user');
    }
}
