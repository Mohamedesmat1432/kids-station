<?php

namespace App\Livewire\License;

use App\Livewire\Forms\LicenseForm;
use App\Models\License;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class BulkDeleteLicense extends Component
{
    use WithNotify;

    public LicenseForm $form;
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
        $this->dispatch('bulk-delete-license');
        $this->dispatch('bulk-delete-clear');
        $this->successNotify(__('Licenses deleted successfully'));
        $this->bulk_delete_modal = false;
    }

    public function render()
    {
        return view('livewire.license.bulk-delete-license');
    }
}
