<?php

namespace App\Livewire\Unit;

use App\Traits\UnitTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ListUnit extends Component
{
    use UnitTrait;

    #[On('bulk-delete-clear')]
    #[On('force-bulk-delete-clear')]
    public function checkboxClear()
    {
        $this->checkbox_arr = [];
    }

    #[On('create-unit')]
    #[On('update-unit')]
    #[On('delete-unit')]
    #[On('import-unit')]
    #[On('export-unit')]
    #[On('force-delete-unit')]
    #[On('force-bulk-delete-unit')]
    #[On('restore-unit')]
    public function render()
    {
        $this->authorize('view-unit');

        $units = $this->unitList();

        return view('livewire.unit.list-unit', [
            'units' => $units,
        ]);
    }
}
