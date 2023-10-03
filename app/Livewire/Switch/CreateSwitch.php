<?php

namespace App\Livewire\Switch;

use App\Livewire\Forms\SwitchForm;
use App\Traits\WithNotify;
use Livewire\Component;

class CreateSwitch extends Component
{
    use WithNotify;

    public SwitchForm $form;

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
        $this->dispatch('create-switch');
        $this->successNotify(__('Switch created successfully'));
        $this->create_modal = false;
    }

    public function render()
    {
        return view('livewire.switch.create-switch');
    }
}
