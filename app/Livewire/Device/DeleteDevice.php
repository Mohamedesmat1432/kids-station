<?php

namespace App\Livewire\Device;

use App\Livewire\Forms\DeviceForm;
use App\Models\Device;
use App\Traits\WithNotify;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteDevice extends Component
{
    use WithNotify;

    public DeviceForm $form;

    public $delete_modal = false;

    #[On('delete-modal')]
    public function confirmDelete(Device $id)
    {
        $this->form->setDevice($id);
        $this->delete_modal = true;
    }

    public function delete()
    {
        $this->form->delete();
        $this->dispatch('delete-device');
        $this->successNotify(__('Device deleted successfully'));
        $this->delete_modal = false;
    }

    public function render()
    {
        return view('livewire.device.delete-device');
    }
}
