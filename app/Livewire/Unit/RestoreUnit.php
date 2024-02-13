<?php

namespace App\Livewire\Unit;

use App\Traits\UnitTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class RestoreUnit extends Component
{
    use UnitTrait;

    #[Locked]
    public $id, $name;

    #[On('restore-modal')]
    public function confirmRestore($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->restore_modal = true;
    }

    public function restore()
    {
        $this->authorize('restore-unit');
        $this->restoreUnit($this->id);
        $this->dispatch('restore-unit');
        $this->successNotify(__('site.unit_deleted'));
        $this->restore_modal = false;
    }

    public function render()
    {
        return view('livewire.unit.restore-unit');
    }
}
