<?php

namespace App\Livewire\EmadEdeen;

use App\Livewire\Forms\EmadEdeenForm;
use App\Models\EmadEdeen;
use App\Traits\SortSearchTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListSchema extends Component
{
    use WithPagination, SortSearchTrait;

    public EmadEdeenForm $form;

    public function checkboxAll()
    {
        $this->form->checkboxAll();
    }

    #[On('bulk-delete-clear')]
    public function checkboxClear()
    {
        $this->form->checkbox_arr = [];
    }

    #[On('create-schema')]
    #[On('update-schema')]
    #[On('delete-schema')]
    #[On('import-schema')]
    #[On('export-schema')]
    #[On('bulk-delete-schema')]
    public function render()
    {
        $this->authorize('view-schema');

        $emadEdeens = EmadEdeen::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')->paginate($this->page_element);

        return view('livewire.emad-edeen.list-schema', [
            'emadEdeens' => $emadEdeens
        ]);
    }
}
