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
    }

    #[On('refresh-list-unit')]
    public function render()
    {
        $this->authorize('view-unit');

        $units = $this->trash ? Unit::onlyTrashed() : Unit::withoutTrashed();

        $units = $units->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
            ->search($this->search)->paginate($this->page_element);

        return view('livewire.unit.list-unit', [
            'units' => $units,
        ]);
    }
}
