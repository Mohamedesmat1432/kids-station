<?php

namespace App\Livewire\TypeName;

use App\Traits\TypeNameTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class ForceDeleteTypeName extends Component
{
    use TypeNameTrait;

    #[Locked]
    public $id, $name;

    #[On('force-delete-modal')]
    public function confirmDelete($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->force_delete_modal = true;
    }

    public function delete()
    {
        $this->authorize('force-delete-type-name');
        $this->forceDeleteTypeName($this->id);
        $this->dispatch('refresh-list-type-name');
        $this->successNotify(__('site.type_name_deleted'));
        $this->force_delete_modal = false;
    }

    public function render()
    {
        return view('livewire.type-name.force-delete-type-name');
    }
}
