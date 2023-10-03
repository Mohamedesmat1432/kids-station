<?php

namespace App\Livewire\Ip;

use App\Livewire\Forms\IpForm;
use App\Traits\WithNotify;
use Livewire\Component;

class CreateIp extends Component
{
    use WithNotify;

    public IpForm $form;

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
        $this->dispatch('create-ip');
        $this->successNotify(__('Ip created successfully'));
        $this->create_modal = false;
    }
    public function render()
    {
        return view('livewire.ip.create-ip');
    }
}
