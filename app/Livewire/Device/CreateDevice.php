<?php

namespace App\Livewire\Device;

use App\Livewire\Forms\DeviceForm;
use App\Traits\WithNotify;
use Livewire\Component;

class CreateDevice extends Component
{
    use WithNotify;

    public DeviceForm $form;

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
        $this->dispatch('create-device');
        $this->successNotify(__('Device created successfully'));
        $this->create_modal = false;
    }

    public function render()
    {
        return view('livewire.device.create-device');
    }
}
