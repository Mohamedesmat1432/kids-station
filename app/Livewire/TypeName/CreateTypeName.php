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
        $this->authorize('create-type-name');
        $this->storeTypeName();
        $this->dispatch('refresh-list-type-name');
        $this->successNotify(__('site.type_name_created'));
        $this->create_modal = false;
    }

    public function render()
    {
        return view('livewire.type-name.create-type-name');
    }
}
