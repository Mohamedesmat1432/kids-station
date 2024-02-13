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
        $this->authorize('force-bulk-delete-type-name');
        $this->forceBulkDeleteTypeName();
        $this->dispatch('force-bulk-delete-type-name');
        $this->dispatch('force-bulk-delete-clear');
        $this->successNotify(__('site.type_delete_all'));
        $this->force_bulk_delete_modal = false;
    }

    public function render()
    {
        return view('livewire.type-name.force-bulk-delete-type-name');
    }
}
