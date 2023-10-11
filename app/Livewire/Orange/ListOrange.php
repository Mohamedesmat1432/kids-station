<?php

namespace App\Livewire\Orange;

use App\Livewire\Forms\OrangeForm;
use App\Models\Orange;
use App\Traits\SortSearchTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListOrange extends Component
{
    use WithPagination, SortSearchTrait;

    public OrangeForm $form;

    public function checkboxAll()
    {
        $this->form->checkboxAll();
    }

    #[On('bulk-delete-clear')]
    public function checkboxClear()
    {
        $this->form->checkbox_arr = [];
    }

    #[On('create-orange')]
    #[On('update-orange')]
    #[On('delete-orange')]
    #[On('import-orange')]
    #[On('export-orange')]
    #[On('bulk-delete-orange')]
    public function render()
    {
        $this->authorize('view-orange');

        $oranges = Orange::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('status', 'like', '%' . $this->search . '%')
                    ->orWhere('start_date', 'like', '%' . $this->search . '%')
                    ->orWhere('end_date', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')->paginate($this->page_element);

        return view('livewire.orange.list-orange', [
            'oranges' => $oranges
        ]);
    }
}
