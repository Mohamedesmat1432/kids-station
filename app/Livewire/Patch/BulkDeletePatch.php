<?php

namespace App\Livewire\Patch;

use App\Models\PatchBranch;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class BulkDeletePatch extends Component
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
        $patchs = PatchBranch::whereIn('id', $this->arr);

        foreach ($patchs as $patch) {
            $patch->edokis()->update(['patch_id' => null]);
            $patch->emadEdeens()->update(['patch_id' => null]);
        }
        
        $patchs->delete();
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
