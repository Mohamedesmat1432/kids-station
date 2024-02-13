<?php

namespace App\Livewire\Type;

use App\Traits\TypeTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ListType extends Component
{
    use TypeTrait;

    #[On('bulk-delete-clear')]
    #[On('force-bulk-delete-clear')]
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
    #[On('restore-type')]
    #[On('force-delete-type')]
    #[On('force-bulk-delete-type')]
    public function render()
    {
        $this->authorize('view-type');

        $types = $this->typeList();

        return view('livewire.type.list-type', [
            'types' => $types,
        ]);
    }
}
