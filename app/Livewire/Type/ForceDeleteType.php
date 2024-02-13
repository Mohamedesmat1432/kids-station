<?php

namespace App\Livewire\Type;

use App\Traits\TypeTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class ForceDeleteType extends Component
{
    use TypeTrait;

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
        $this->authorize('force-delete-type');
        $this->forceDeleteType($this->id);
        $this->dispatch('force-delete-type');
        $this->successNotify(__('site.type_deleted'));
        $this->force_delete_modal = false;
    }

    public function render()
    {
        return view('livewire.type.force-delete-type');
    }
}
