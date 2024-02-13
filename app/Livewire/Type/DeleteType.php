<?php

namespace App\Livewire\Type;

use App\Traits\TypeTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteType extends Component
{
    use TypeTrait;

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
        $this->authorize('delete-type');
        $this->deleteType($this->id);
        $this->dispatch('delete-type');
        $this->successNotify(__('site.type_deleted'));
        $this->delete_modal = false;
    }

    public function render()
    {
        return view('livewire.type.delete-type');
    }
}
