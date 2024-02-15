<?php

namespace App\Livewire\Type;

use App\Traits\TypeTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class BulkDeleteType extends Component
{
    use TypeTrait;
    
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
        $this->authorize('bulk-delete-type');
        $this->bulkDeleteType();
        $this->dispatch('refresh-list-type');
        $this->dispatch('checkbox-clear');
        $this->successNotify(__('site.type_delete_all'));
        $this->bulk_delete_modal = false;
    }

    public function render()
    {
        return view('livewire.type.bulk-delete-type');
    }
}
