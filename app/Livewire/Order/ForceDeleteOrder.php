<?php

namespace App\Livewire\Order;

use App\Traits\OrderTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class ForceDeleteOrder extends Component
{
    use OrderTrait;

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
        $this->authorize('force-delete-order');
        $this->forceDeleteOrder($this->id);
        $this->dispatch('force-delete-order');
        $this->successNotify(__('site.order_deleted'));
        $this->force_delete_modal = false;
    }

    public function render()
    {
        return view('livewire.order.force-delete-order');
    }
}
