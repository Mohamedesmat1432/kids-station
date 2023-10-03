<?php

namespace App\Livewire\Device;

use App\Models\Device;
use App\Traits\SortSearchTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListDevice extends Component
{
    use WithPagination, SortSearchTrait;

    #[On('create-device')]
    #[On('update-device')]
    #[On('delete-device')]
    public function render()
    {
        $this->authorize('view-device');

        $devices = Device::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('serial', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')->paginate(10);

        return view('livewire.device.list-device', [
            'devices' => $devices
        ]);
    }
}
