<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use App\Traits\WithNotify;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteUser extends Component
{
    use WithNotify;

    public UserForm $form;

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
        $this->dispatch('delete-user');
        $this->successNotify(__('User deleted successfully'));
        $this->delete_modal = false;
    }

    public function render()
    {
        return view('livewire.user.delete-user');
    }
}
