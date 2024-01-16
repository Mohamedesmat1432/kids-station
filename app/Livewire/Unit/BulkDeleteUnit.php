<?php

namespace App\Livewire\Unit;

use App\Traits\UnitTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class BulkDeleteUnit extends Component
{
    use UnitTrait;
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
        $this->authorize('bulk-delete-unit');
        $this->bulkDeleteTypeName();
        $this->dispatch('bulk-delete-unit');
        $this->dispatch('bulk-delete-clear');
        $this->successNotify(__('site.unit_delete_all'));
        $this->bulk_delete_modal = false;
    }

    public function render()
    {
        return view('livewire.unit.bulk-delete-unit');
    }
}
