<?php

namespace App\Livewire\Unit;

use App\Traits\UnitTrait;
use Livewire\Component;

class CreateUnit extends Component
{
    use UnitTrait;

    public function createModal()
    {
        $this->reset();
        $this->resetValidation();
        $this->create_modal = true;
    }

    public function save()
    {
        $this->storeUnit();
    }

    public function render()
    {
        return view('livewire.unit.create-unit');
    }
}
