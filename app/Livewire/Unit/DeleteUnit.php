<?php

namespace App\Livewire\Unit;

use App\Traits\UnitTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteUnit extends Component
{
    use UnitTrait;

    #[Locked]
    public $id, $name;

    #[On('delete-modal')]
    public function confirmDelete($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->delete_modal = true;
    }

    public function delete()
    {
        $this->authorize('delete-unit');
        $this->deleteUnit($this->id);
        $this->dispatch('refresh-list-unit');
        $this->successNotify(__('site.unit_deleted'));
        $this->delete_modal = false;
    }

    public function render()
    {
        return view('livewire.unit.delete-unit');
    }
}
