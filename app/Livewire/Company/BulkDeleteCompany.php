<?php

namespace App\Livewire\Company;

use App\Livewire\Forms\CompanyForm;
use App\Models\Company;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class BulkDeleteCompany extends Component
{
    use WithNotify;

    public CompanyForm $form;
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
        $this->dispatch('bulk-delete-company');
        $this->dispatch('bulk-delete-clear');
        $this->successNotify(__('Companies deleted successfully'));
        $this->bulk_delete_modal = false;
    }

    public function render()
    {
        return view('livewire.company.bulk-delete-company');
    }
}
