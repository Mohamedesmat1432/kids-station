<?php

namespace App\Livewire\TypeName;

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
    }

    #[On('refresh-list-type-name')]
    public function render()
    {
        $this->authorize('view-type-name');

        return view('livewire.type-name.list-type-name', [
            'type_names' => $this->typeNameList(),
        ])->layout('layouts.app');
    }
}
