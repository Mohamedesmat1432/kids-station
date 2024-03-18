<?php

namespace App\Livewire\TypeName;

use App\Traits\TypeNameTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ForceBulkDeleteTypeName extends Component
{
    use TypeNameTrait;

    public $count;

    #[On('force-bulk-delete-modal')]
    public function confirmDelete($arr)
    {
        $this->checkbox_arr = json_decode($arr);
        $this->count = count($this->checkbox_arr);
        $this->force_bulk_delete_modal = true;
    }

    public function delete()
    {
        $this->forceBulkDeleteTypeName($this->checkbox_arr);
    }

    public function render()
    {
        return view('livewire.type-name.force-bulk-delete-type-name');
    }
}
