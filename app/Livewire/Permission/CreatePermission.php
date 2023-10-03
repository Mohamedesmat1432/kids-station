<?php

namespace App\Livewire\Permission;

use App\Livewire\Forms\PermissionForm;
use App\Traits\WithNotify;
use Livewire\Component;

class CreatePermission extends Component
{
    use WithNotify;

    public PermissionForm $form;

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
        $this->dispatch('create-permission');
        $this->successNotify(__('Permission created successfully'));
        $this->create_modal = false;
    }

    public function render()
    {
        return view('livewire.permission.create-permission');
    }
}
