<?php

namespace App\Livewire\Point;

use App\Models\Point;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class BulkDeletePoint extends Component
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
        $points = Point::whereIn('id', $this->arr);

        foreach ($points as $point) {
            $point->edokis()->update(['point_id' => null]);
            $point->emadEdeens()->update(['point_id' => null]);
        }
        
        $points->delete();
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
