<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use App\Models\Role;
use App\Traits\WithNotify;
use Livewire\Component;

class CreateUser extends Component
{
    use WithNotify;

    public UserForm $form;

    public $create_modal = false;

    public function createModal()
    {
        $this->form->reset();
        $this->resetValidation();
        $this->create_modal = true;
    }

    public function save()
    {
        $this->form->store();
        $this->dispatch('create-user');
        $this->successNotify(__('User created successfully'));
        $this->create_modal = false;
    }

    public function render()
    {
        $roles = Role::pluck('name','id');

        return view('livewire.user.create-user',[
            'roles' => $roles
        ]);
    }
}
