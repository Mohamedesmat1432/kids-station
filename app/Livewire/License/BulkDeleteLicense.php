<?php

namespace App\Livewire\License;

use App\Models\License;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class BulkDeleteLicense extends Component
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
        $companies = License::whereIn('id', $this->arr);
        $companies->delete();
        $this->dispatch('bulk-delete-license');
        $this->dispatch('bulk-delete-clear');
        $this->successNotify(__('Companies deleted successfully'));
        $this->bulk_delete_modal = false;
    }

    public function render()
    {
        return view('livewire.license.bulk-delete-license');
    }
}
