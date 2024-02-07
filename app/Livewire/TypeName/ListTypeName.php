<?php

namespace App\Livewire\TypeName;

use App\Models\TypeName;
use App\Traits\SortSearchTrait;
use App\Traits\TypeNameTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListTypeName extends Component
{
    use WithPagination, SortSearchTrait, TypeNameTrait;

    #[On('bulk-delete-clear')]
    public function checkboxClear()
    {
        $this->checkbox_arr = [];
    }

    #[On('create-type-name')]
    #[On('update-type-name')]
    #[On('delete-type-name')]
    #[On('import-type-name')]
    #[On('export-type-name')]
    #[On('bulk-delete-type-name')]
    public function render()
    {
        $this->authorize('view-type-name');

        $type_names = cache()->remember('type_names', 1, function () {
            return TypeName::when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                });
            })
                ->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
                ->paginate($this->page_element);
        });
        
        return view('livewire.type-name.list-type-name', [
            'type_names' => $type_names,
        ]);
    }
}
