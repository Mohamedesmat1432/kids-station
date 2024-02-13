<?php

namespace App\Livewire\TypeName;

use App\Models\TypeName;
use App\Traits\SortSearchTrait;
use App\Traits\TypeNameTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListTypeName extends Component
{
    use TypeNameTrait;

    #[On('bulk-delete-clear')]
    #[On('force-bulk-delete-clear')]
    public function checkboxClear()
    {
        $this->checkbox_arr = [];
    }

    #[On('create-type-name')]
    #[On('update-type-name')]
    #[On('delete-type-name')]
    #[On('import-type-name')]
    #[On('export-type-name')]
    #[On('bulk-delete-type-name')]
    #[On('restore-type-name')]
    #[On('force-delete-type-name')]
    #[On('force-bulk-delete-type-name')]
    public function render()
    {
        $this->authorize('view-type-name');

        $type_names = $this->typeNameList();
        
        return view('livewire.type-name.list-type-name', [
            'type_names' => $type_names,
        ]);
    }
}
