<?php

namespace App\Livewire\Type;

use App\Models\TypeName;
use App\Traits\TypeTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class UpdateType extends Component
{
    use TypeTrait;

    #[On('edit-modal')]
    public function confirmEdit($id)
    {
        $this->reset();
        $this->resetValidation();
        $this->setType($id);
        $this->edit_modal = true;
    }

    public function save()
    {
        $this->updateType();
    }

    public function render()
    {
        $type_names = TypeName::get();
        
        return view('livewire.type.update-type',[
            'type_names' => $type_names,
        ]);    }
}
