<?php

namespace App\Livewire\Device;

use App\Livewire\Forms\DeviceForm;
use App\Models\Device;
use App\Traits\SortSearchTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListDevice extends Component
{
    use WithPagination, SortSearchTrait;

    public DeviceForm $form;

    public function checkboxAll()
    {
        $this->form->checkboxAll();
    }

    #[On('bulk-delete-clear')]
    public function checkboxClear()
    {
        $this->form->checkbox_arr = [];
    }

    #[On('create-device')]
    #[On('update-device')]
    #[On('delete-device')]
    #[On('bulk-delete-device')]
    public function render()
    {
        $this->authorize('view-device');

        $devices = Device::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('serial', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')->paginate($this->page_element);

        return view('livewire.device.list-device', [
            'devices' => $devices
        ]);
    }
}
