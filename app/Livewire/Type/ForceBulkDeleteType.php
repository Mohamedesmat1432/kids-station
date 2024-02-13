<?php

namespace App\Livewire\Type;

use App\Traits\TypeTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ForceBulkDeleteType extends Component
{
    use TypeTrait;

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
        $this->authorize('force-bulk-delete-type');
        $this->forceBulkDeleteType();
        $this->dispatch('force-bulk-delete-type');
        $this->dispatch('force-bulk-delete-clear');
        $this->successNotify(__('site.type_delete_all'));
        $this->force_bulk_delete_modal = false;
    }

    public function render()
    {
        return view('livewire.type.force-bulk-delete-type');
    }
}
