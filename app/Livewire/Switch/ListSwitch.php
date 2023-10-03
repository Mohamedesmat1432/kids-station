<?php

namespace App\Livewire\Switch;

use App\Models\SwitchBranch;
use App\Traits\SortSearchTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListSwitch extends Component
{
    use WithPagination, SortSearchTrait;

    #[On('create-switch')]
    #[On('update-switch')]
    #[On('delete-switch')]
    public function render()
    {
        $this->authorize('view-switch');

        $switchs = SwitchBranch::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('hostname', 'like', '%' . $this->search . '%');
            });
        })->latest()->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')->paginate(10);

        return view('livewire.switch.list-switch', [
            'switchs' => $switchs
        ]);
    }
}
