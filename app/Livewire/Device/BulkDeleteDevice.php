<?php

namespace App\Livewire\Device;

use App\Livewire\Forms\DeviceForm;
use App\Models\Device;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class BulkDeleteDevice extends Component
{
    use WithNotify;

    public DeviceForm $form;
    public $bulk_delete_modal = false;
    public $count;

    #[On('bulk-delete-modal')]
    public function confirmDelete($arr)
    {
        $this->form->checkbox_arr = json_decode($arr);
        $this->count = count($this->form->checkbox_arr);
        $this->bulk_delete_modal = true;
    }

    public function delete()
    {
        $this->form->bulkDelete();
        $this->dispatch('bulk-delete-device');
        $this->dispatch('bulk-delete-clear');
        $this->successNotify(__('Devices deleted successfully'));
        $this->bulk_delete_modal = false;
    }

    public function render()
    {
        return view('livewire.device.bulk-delete-device');
    }
}
