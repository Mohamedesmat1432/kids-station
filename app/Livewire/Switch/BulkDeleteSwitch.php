<?php

namespace App\Livewire\Switch;

use App\Livewire\Forms\SwitchForm;
use App\Models\SwitchBranch;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class BulkDeleteSwitch extends Component
{
    use WithNotify;

    public SwitchForm $form;
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
        $this->dispatch('bulk-delete-switch');
        $this->dispatch('bulk-delete-clear');
        $this->successNotify(__('Switchs deleted successfully'));
        $this->bulk_delete_modal = false;
    }

    public function render()
    {
        return view('livewire.switch.bulk-delete-switch');
    }
}
