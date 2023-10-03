<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use App\Models\Role;
use App\Models\User;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class UpdateUser extends Component
{
    use WithNotify;

    public UserForm $form;

    public $edit_modal = false;

    #[On('edit-modal')]
    public function confirmEdit(User $id)
    {
        $this->form->reset();
        $this->resetValidation();
        $this->form->setUser($id);
        $this->edit_modal = true;
    }

    public function save()
    {
        $this->form->update();
        $this->dispatch('refresh-navigation-menu');
        $this->dispatch('update-user');
        $this->successNotify(__('User updated successfully'));
        $this->edit_modal = false;
    }

    public function render()
    {
        $roles = Role::pluck('name','id');

        return view('livewire.user.update-user',[
            'roles' => $roles
        ]);
    }
}
