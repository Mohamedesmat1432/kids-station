<?php

namespace App\Livewire\Unit;

use App\Models\Unit;
use App\Traits\SortSearchTrait;
use App\Traits\UnitTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListUnit extends Component
{
    use WithPagination, SortSearchTrait, UnitTrait;

    #[On('bulk-delete-clear')]
    public function checkboxClear()
    {
        $this->checkbox_arr = [];
    }

    #[On('create-unit')]
    #[On('update-unit')]
    #[On('delete-unit')]
    #[On('import-unit')]
    #[On('export-unit')]
    #[On('bulk-delete-unit')]
    public function render()
    {
        $this->authorize('view-unit');

        $units = Unit::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')->paginate($this->page_element);

        return view('livewire.unit.list-unit', [
            'units' => $units
        ]);
    }
}
