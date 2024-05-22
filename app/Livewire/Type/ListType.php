<?php

namespace App\Livewire\Type;

use App\Models\Type;
use App\Traits\TypeTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ListType extends Component
{
    use TypeTrait;

    #[On('checkbox-clear')]
    public function checkboxClear()
    {
        $this->checkbox_arr = [];
    }

    #[On('refresh-list-type')]
    public function render()
    {
        $this->authorize('view-type');

        $types = $this->trash ? Type::onlyTrashed() : Type::withoutTrashed();
            
        $types = $types->search($this->search)
            ->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
            ->paginate($this->page_element);

        return view('livewire.type.list-type', [
            'types' => $types,
        ]);
    }
}
