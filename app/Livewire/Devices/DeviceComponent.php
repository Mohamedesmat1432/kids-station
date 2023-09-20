<?php

namespace App\Livewire\Devices;

use App\Models\Device;
use App\Traits\DeviceTrait;
use Livewire\Component;

class DeviceComponent extends Component
{
    use DeviceTrait;

    public function render()
    {
        $this->authorize('view-device');

        $devices = Device::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('serial', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')->paginate(10);

        return view('livewire.devices.device-component', [
            'devices' => $devices
        ]);
    }
    public function confirmDeviceAdd()
    {
        $this->resetItems();
        $this->confirm_form = true;
    }

    public function confirmDeviceEdit($id)
    {
        $this->resetItems();
        $this->confirm_form = true;
        $device = Device::findOrFail($id);
        $this->device_id = $device->id;
        $this->name = $device->name;
        $this->serial = $device->serial;
        $this->specifications = $device->specifications;
    }

    public function saveDevice()
    {
        $validated = $this->validate();
        if (isset($this->device_id)) {
            $device = Device::findOrFail($this->device_id);
            $device->update($validated);
            $this->successMessage(__('Device updated successfully'));
        } else {
            Device::create($validated);
            $this->successMessage(__('Device created successfully'));
        }

        $this->confirm_form = false;
    }

    public function confirmDeviceDeletion($id)
    {
        $this->confirm_delete = $id;
    }

    public function deleteDevice()
    {
        $device = Device::findOrFail($this->confirm_delete);
        $device->edokis()->update(['device_id' => null]);
        $device->emadEdeens()->update(['device_id' => null]);
        $device->delete();
        $this->successMessage(__('Device deleted successfully'));
        $this->confirm_delete = false;
    }

}
