<?php

namespace App\Livewire\Unit;

use App\Models\Unit;
use App\Traits\UnitTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ListUnit extends Component
{
    use UnitTrait;

    #[On('checkbox-clear')]
    public function checkboxClear()
    {
        $this->checkbox_arr = [];
        $this->checkbox_status = false;
    }

    #[On('refresh-list-unit')]
    public function render()
    {
        $this->authorize('view-unit');

        $units = $this->trash ? Unit::onlyTrashed() : Unit::withoutTrashed();

        $units = $units->search($this->search)
            ->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
            ->paginate($this->page_element);

        $this->checkbox_all = $units->pluck('id')->toArray();

        return view('livewire.unit.list-unit', [
            'units' => $units,
        ]);
    }
}
