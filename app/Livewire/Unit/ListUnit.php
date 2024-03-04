<?php

namespace App\Livewire\Unit;

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

        return view('livewire.unit.list-unit', [
            'units' => $this->unitList(),
        ])->layout('layouts.app');
    }
}
