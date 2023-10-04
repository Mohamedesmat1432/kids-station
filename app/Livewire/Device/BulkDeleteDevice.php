<?php

namespace App\Livewire\Device;

use App\Models\Device;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class BulkDeleteDevice extends Component
{
    use WithNotify;

    public $bulk_delete_modal = false;
    public $arr = [], $count;

    #[On('bulk-delete-modal')]
    public function confirmDelete($arr)
    {
        $this->arr = explode(',', $arr);
        $this->count = count($this->arr);
        $this->bulk_delete_modal = true;
    }

    public function delete()
    {
        $devices = Device::whereIn('id', $this->arr);

        foreach ($devices as $device) {
            $device->edokis()->update(['device_id' => null]);
            $device->emadEdeens()->update(['device_id' => null]);
        }
        
        $devices->delete();
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
