<?php

namespace App\Livewire\Patch;

use App\Livewire\Forms\PatchForm;
use App\Models\PatchBranch;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class BulkDeletePatch extends Component
{
    use WithNotify;

    public PatchForm $form;
    public $bulk_delete_modal = false;
    public $count;

    #[On('bulk-delete-modal')]
    public function confirmDelete($arr)
    {
        $this->form->checkbox_arr = explode(',', $arr);
        $this->count = count($this->form->checkbox_arr);
        $this->bulk_delete_modal = true;
    }

    public function delete()
    {
        $this->form->bulkDelete();
        $this->dispatch('bulk-delete-patch');
        $this->dispatch('bulk-delete-clear');
        $this->successNotify(__('Patchs deleted successfully'));
        $this->bulk_delete_modal = false;
    }

    public function render()
    {
        return view('livewire.patch.bulk-delete-patch');
    }
}
