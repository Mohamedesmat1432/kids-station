<?php

namespace App\Livewire\Company;

use App\Models\Company;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class BulkDeleteCompany extends Component
{
    use WithNotify;

    public $bulk_delete_modal = false;
    public $arr = [], $count;

    #[On('bulk-delete-modal')]
    public function confirmDelete($arr)
    {
        $this->arr = explode(',', $arr);
        $this->count = count($this->arr);
        $this->bulk_delete_modal = true;
    }

    public function delete()
    {
        $companies = Company::whereIn('id', $this->arr);
        $companies->delete();
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
