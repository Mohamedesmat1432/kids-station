<?php

namespace App\Livewire\Ip;

use App\Livewire\Forms\IpForm;
use App\Models\Ip;
use App\Traits\SortSearchTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListIp extends Component
{
    use WithPagination, SortSearchTrait;

    public IpForm $form;

    public function checkboxAll()
    {
        $this->form->checkboxAll();
    }

    #[On('bulk-delete-clear')]
    public function checkboxClear()
    {
        $this->form->checkbox_arr = [];
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
        })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')->paginate($this->page_element);

        return view('livewire.ip.list-ip', [
            'ips' => $ips
        ]);
    }
}
