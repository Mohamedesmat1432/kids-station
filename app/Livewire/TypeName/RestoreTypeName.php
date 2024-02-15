<?php

namespace App\Livewire\TypeName;

use App\Traits\TypeNameTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class RestoreTypeName extends Component
{
    use TypeNameTrait;

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
        $this->authorize('restore-type-name');
        $this->restoreTypeName($this->id);
        $this->dispatch('refresh-list-type-name');
        $this->successNotify(__('site.type_restored'));
        $this->restore_modal = false;
    }

    public function render()
    {
        return view('livewire.type-name.restore-type-name');
    }
}
