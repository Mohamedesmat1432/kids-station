<?php

namespace App\Livewire\TypeName;

use App\Traits\TypeNameTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteTypeName extends Component
{
    use TypeNameTrait;
    public $delete_modal = false;

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
        $this->authorize('delete-type-name');
        $this->deleteTypeName($this->id);
        $this->dispatch('delete-type-name');
        $this->successNotify(__('site.type_name_deleted'));
        $this->delete_modal = false;
    }

    public function render()
    {
        return view('livewire.type-name.delete-type-name');
    }
}
