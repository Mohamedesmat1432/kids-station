<?php

namespace App\Livewire\EmadEdeen;

use App\Models\EmadEdeen;
use App\Traits\SortSearchTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListSchema extends Component
{
    use WithPagination, SortSearchTrait;

    #[On('create-schema')]
    #[On('update-schema')]
    #[On('delete-schema')]
    #[On('import-schema')]
    public function render()
    {
        $this->authorize('view-schema');

        $emadEdeens = EmadEdeen::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')->paginate(10);

        return view('livewire.emad-edeen.list-schema', [
            'emadEdeens' => $emadEdeens
        ]);
    }
}
