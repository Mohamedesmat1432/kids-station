<?php

namespace App\Livewire\Orange;

use App\Livewire\Forms\OrangeForm;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class BulkDeleteOrange extends Component
{
    use WithNotify;

    public OrangeForm $form;
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
        $this->dispatch('bulk-delete-orange');
        $this->dispatch('bulk-delete-clear');
        $this->successNotify(__('Orange deleted successfully'));
        $this->bulk_delete_modal = false;
    }

    public function render()
    {
        return view('livewire.orange.bulk-delete-orange');
    }
}
