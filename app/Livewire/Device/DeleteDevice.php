<?php

namespace App\Livewire\Device;

use App\Livewire\Forms\DeviceForm;
use App\Traits\WithNotify;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteDevice extends Component
{
    use WithNotify;

    public DeviceForm $form;

    public $delete_modal = false;

    #[Locked]
    public $id, $name;

    #[On('delete-modal')]
    public function confirmDelete($id,$name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->delete_modal = true;
    }

    public function delete()
    {
        $this->form->delete($this->id);
        $this->dispatch('delete-device');
        $this->successNotify(__('Device deleted successfully'));
        $this->delete_modal = false;
    }

    public function render()
    {
        return view('livewire.device.delete-device');
    }
}
