<?php

namespace App\Livewire\Type;

use App\Models\TypeName;
use App\Traits\TypeTrait;
use Livewire\Component;

class CreateType extends Component
{
    use TypeTrait;

    public function createModal()
    {
        $this->reset();
        $this->resetValidation();
        $this->create_modal = true;
    }

    public function save()
    {
        $this->storeType();
    }

    public function render()
    {
        $type_names = TypeName::get();

        return view('livewire.type.create-type',[
            'type_names' => $type_names,
        ]);
    }
}
