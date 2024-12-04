<?php

namespace App\Livewire\TypeName;

use App\Models\TypeName;
use App\Traits\TypeNameTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ListTypeName extends Component
{
    use TypeNameTrait;

    #[On('checkbox-clear')]
    public function checkboxClear()
    {
        $this->checkbox_arr = [];
        $this->checkbox_status = false;
    }

    #[On('refresh-list-type-name')]
    public function render()
    {
        $this->authorize('view-type-name');

        $type_names = $this->trash ? TypeName::onlyTrashed() : TypeName::withoutTrashed();
            
        $type_names = $type_names->search($this->search)
            ->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
            ->paginate($this->page_element);

        $this->checkbox_all = $type_names->pluck('id')->toArray();

        return view('livewire.type-name.list-type-name', [
            'type_names' => $type_names,
        ]);
    }
}
