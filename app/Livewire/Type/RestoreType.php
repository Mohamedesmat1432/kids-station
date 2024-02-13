<?php

namespace App\Livewire\Type;

use App\Traits\TypeTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class RestoreType extends Component
{
    use TypeTrait;

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
        $this->authorize('restore-type');
        $this->restoreType($this->id);
        $this->dispatch('restore-type');
        $this->successNotify(__('site.type_restored'));
        $this->restore_modal = false;
    }

    public function render()
    {
        return view('livewire.type.restore-type');
    }
}
