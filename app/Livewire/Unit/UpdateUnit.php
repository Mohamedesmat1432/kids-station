<?php

namespace App\Livewire\Unit;

use App\Traits\UnitTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class UpdateUnit extends Component
{
    use UnitTrait;
    public $edit_modal = false;

    #[On('edit-modal')]
    public function confirmEdit($id)
    {
        $this->reset();
        $this->resetValidation();
        $this->setUnit($id);
        $this->edit_modal = true;
    }

    public function save()
    {
        $this->authorize('edit-unit');
        $this->updateUnit();
        $this->dispatch('refresh-list-unit');
        $this->successNotify(__('site.unit_updated'));
        $this->edit_modal = false;
    }

    public function render()
    {
        return view('livewire.unit.update-unit');
    }
}
