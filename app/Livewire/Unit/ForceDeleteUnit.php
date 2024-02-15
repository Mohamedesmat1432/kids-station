<?php

namespace App\Livewire\Unit;

use App\Traits\UnitTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class ForceDeleteUnit extends Component
{
    use UnitTrait;

    #[Locked]
    public $id, $name;

    #[On('force-delete-modal')]
    public function confirmDelete($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->force_delete_modal = true;
    }

    public function delete()
    {
        $this->authorize('force-delete-unit');
        $this->forceDeleteUnit($this->id);
        $this->dispatch('refresh-list-unit');
        $this->successNotify(__('site.unit_deleted'));
        $this->force_delete_modal = false;
    }

    public function render()
    {
        return view('livewire.unit.force-delete-unit');
    }
}
