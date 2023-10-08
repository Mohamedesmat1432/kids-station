<?php

namespace App\Livewire\Switch;

use App\Livewire\Forms\SwitchForm;
use App\Models\SwitchBranch;
use App\Traits\SortSearchTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListSwitch extends Component
{
    use WithPagination, SortSearchTrait;

    public SwitchForm $form;

    public function checkboxAll()
    {
       $this->form->checkboxAll();
    }

    #[On('bulk-delete-clear')]
    public function checkboxClear()
    {
        $this->form->checkbox_arr = [];
    }

    #[On('create-switch')]
    #[On('update-switch')]
    #[On('delete-switch')]
    #[On('bulk-delete-switch')]
    public function render()
    {
        $this->authorize('view-switch');

        $switchs = SwitchBranch::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('hostname', 'like', '%' . $this->search . '%');
            });
        })->latest()->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')->paginate($this->page_element);

        return view('livewire.switch.list-switch', [
            'switchs' => $switchs
        ]);
    }
}
