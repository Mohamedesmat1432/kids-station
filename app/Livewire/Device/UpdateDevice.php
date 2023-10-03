<?php

namespace App\Livewire\Device;

use App\Livewire\Forms\DeviceForm;
use App\Models\Device;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class UpdateDevice extends Component
{
    use WithNotify;

    public DeviceForm $form;

    public $edit_modal = false;

    #[On('edit-modal')]
    public function confirmEdit(Device $id)
    {
        $this->form->reset();
        $this->resetValidation();
        $this->form->setDevice($id);
        $this->edit_modal = true;
    }

    public function save()
    {
        $this->form->update();
        $this->dispatch('update-device');
        $this->successNotify(__('Device updated successfully'));
        $this->edit_modal = false;
    }
    public function render()
    {
        return view('livewire.device.update-device');
    }
}
