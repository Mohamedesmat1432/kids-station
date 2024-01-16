<?php

namespace App\Livewire\Order;

use App\Traits\OrderTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteOrder extends Component
{
    use OrderTrait;
    public $delete_modal = false;

    #[Locked]
    public $id, $name;

    #[On('delete-modal')]
    public function confirmDelete($id, $name)
    {
        $this->id = $id;
        $this->customer_name = $name;
        $this->delete_modal = true;
    }

    public function delete()
    {
        $this->authorize('delete-order');
        $this->deleteOrder($this->id);
        $this->dispatch('delete-order');
        $this->successNotify(__('site.order_deleted'));
        $this->delete_modal = false;
    }

    public function render()
    {
        return view('livewire.order.delete-order');
    }
}
