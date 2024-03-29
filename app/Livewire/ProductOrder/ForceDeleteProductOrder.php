<?php

namespace App\Livewire\ProductOrder;

use App\Traits\ProductOrderTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class ForceDeleteProductOrder extends Component
{
    use ProductOrderTrait;

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
        $this->forceDeleteProductOrder($this->id);
    }

    public function render()
    {
        return view('livewire.product-order.force-delete-product-order');
    }
}
