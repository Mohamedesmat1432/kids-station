<?php

namespace App\Livewire\TypeName;

use App\Traits\TypeNameTrait;
use Livewire\Component;

class CreateTypeName extends Component
{
    use TypeNameTrait;
    public $create_modal = false;

    public function createModal()
    {
        $this->reset();
        $this->resetValidation();
        $this->create_modal = true;
    }

    public function save()
    {
        $this->storeTypeName();
    }

    public function render()
    {
        return view('livewire.type-name.create-type-name');
    }
}
