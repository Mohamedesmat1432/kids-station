<?php

namespace App\Livewire\Type;

use App\Models\Type;
use App\Traits\SortSearchTrait;
use App\Traits\TypeTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListType extends Component
{
    use WithPagination, SortSearchTrait, TypeTrait;

    #[On('bulk-delete-clear')]
    public function checkboxClear()
    {
        $this->checkbox_arr = [];
    }

    #[On('create-type')]
    #[On('update-type')]
    #[On('delete-type')]
    #[On('import-type')]
    #[On('export-type')]
    #[On('bulk-delete-type')]
    public function render()
    {
        $this->authorize('view-type');

        $types = cache()->remember('types', 1, function () {
            return Type::when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('price', 'like', '%' . $this->search . '%');
                });
            })
                ->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
                ->paginate($this->page_element);
        });

        return view('livewire.type.list-type', [
            'types' => $types,
        ]);
    }
}
