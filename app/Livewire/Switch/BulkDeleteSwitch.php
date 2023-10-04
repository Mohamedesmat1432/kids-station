<?php

namespace App\Livewire\Switch;

use App\Models\SwitchBranch;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class BulkDeleteSwitch extends Component
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
        $switchs = SwitchBranch::whereIn('id', $this->arr);

        foreach ($switchs as $switch) {
            $switch->edokis()->update(['switch_id' => null]);
            $switch->emadEdeens()->update(['switch_id' => null]);
        }

        $switchs->delete();
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
