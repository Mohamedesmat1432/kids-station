<?php

namespace App\Livewire\Edoki;

use App\Livewire\Forms\EdokiForm;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class BulkDeleteSchema extends Component
{
    use WithNotify;

    public EdokiForm $form;
    public $bulk_delete_modal = false;
    public $count;

    #[On('bulk-delete-modal')]
    public function confirmDelete($arr)
    {
        $this->form->checkbox_arr = json_decode($arr);
        $this->count = count($this->form->checkbox_arr);
        $this->bulk_delete_modal = true;
    }

    public function delete()
    {
        $this->form->bulkDelete();
        $this->dispatch('bulk-delete-schema');
        $this->dispatch('bulk-delete-clear');
        $this->successNotify(__('Schema deleted successfully'));
        $this->bulk_delete_modal = false;
    }

    public function render()
    {
        return view('livewire.edoki.bulk-delete-schema');
    }
}
