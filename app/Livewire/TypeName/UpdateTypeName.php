<?php

namespace App\Livewire\TypeName;

use App\Traits\TypeNameTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class UpdateTypeName extends Component
{
    use TypeNameTrait;

    #[On('edit-modal')]
    public function confirmEdit($id)
    {
        $this->reset();
        $this->resetValidation();
        $this->setTypeName($id);
        $this->edit_modal = true;
    }

    public function save()
    {
        $this->authorize('edit-type-name');
        $this->updateTypeName();
        $this->dispatch('refresh-list-type-name');
        $this->successNotify(__('site.type_name_updated'));
        $this->edit_modal = false;
    }

    public function render()
    {
        return view('livewire.type-name.update-type-name');
    }
}
