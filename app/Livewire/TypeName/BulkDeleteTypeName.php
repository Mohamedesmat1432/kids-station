<?php

namespace App\Livewire\TypeName;

use App\Traits\TypeNameTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class BulkDeleteTypeName extends Component
{
    use TypeNameTrait;
    public $bulk_delete_modal = false;
    public $count;

    #[On('bulk-delete-modal')]
    public function confirmDelete($arr)
    {
        $this->checkbox_arr = json_decode($arr);
        $this->count = count($this->checkbox_arr);
        $this->bulk_delete_modal = true;
    }

    public function delete()
    {
        $this->authorize('bulk-delete-type-name');
        $this->bulkDeleteTypeName();
        $this->dispatch('bulk-delete-type-name');
        $this->dispatch('bulk-delete-clear');
        $this->successNotify(__('site.type_name_delete_all'));
        $this->bulk_delete_modal = false;
    }

    public function render()
    {
        return view('livewire.type-name.bulk-delete-type-name');
    }
}
