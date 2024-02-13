<?php

namespace App\Livewire\Unit;

use App\Traits\UnitTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ForceBulkDeleteUnit extends Component
{
    use UnitTrait;
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
        $this->authorize('force-bulk-delete-unit');
        $this->forceBulkDeleteUnit();
        $this->dispatch('force-bulk-delete-unit');
        $this->dispatch('force-bulk-delete-clear');
        $this->successNotify(__('site.unit_delete_all'));
        $this->force_bulk_delete_modal = false;
    }

    public function render()
    {
        return view('livewire.unit.force-bulk-delete-unit');
    }
}
