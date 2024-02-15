<?php

namespace App\Livewire\Type;

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

        $types = $this->typeList();

        return view('livewire.type.list-type', [
            'types' => $types,
        ]);
    }
}
