<?php

namespace App\Livewire\Ip;

use App\Models\Ip;
use App\Traits\SortSearchTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListIp extends Component
{
    use WithPagination, SortSearchTrait;

    public $checkbox_arr = [];

    public function checkboxAll()
    {
        if (empty($this->checkbox_arr)) {
            $this->checkbox_arr = Ip::pluck('id')->toArray();
        } else {
            $this->checkbox_arr = [];
        }
    }

    #[On('bulk-delete-clear')]
    public function checkboxClear()
    {
        $this->checkbox_arr = [];
    }

    #[On('create-ip')]
    #[On('update-ip')]
    #[On('delete-ip')]
    #[On('bulk-delete-ip')]
    public function render()
    {
        $this->authorize('view-ip');

        $ips = Ip::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('number', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')->paginate(10);

        return view('livewire.ip.list-ip', [
            'ips' => $ips
        ]);
    }
}
