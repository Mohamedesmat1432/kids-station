<?php

namespace App\Livewire\Point;

use App\Livewire\Forms\PointForm;
use App\Models\Point;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class BulkDeletePoint extends Component
{
    use WithNotify;

    public PointForm $form;
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
        $this->dispatch('bulk-delete-point');
        $this->dispatch('bulk-delete-clear');
        $this->successNotify(__('Points deleted successfully'));
        $this->bulk_delete_modal = false;
    }

    public function render()
    {
        return view('livewire.point.bulk-delete-point');
    }
}
