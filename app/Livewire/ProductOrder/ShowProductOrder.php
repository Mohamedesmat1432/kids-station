<?php

namespace App\Livewire\ProductOrder;

use App\Traits\ProductOrderTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowProductOrder extends Component
{
    use ProductOrderTrait;
    public $show_modal = false;

    #[On('show-modal')]
    public function showModal($id)
    {
        $this->authorize('show-product-order');
        $this->setProductOrder($id);
        $this->show_modal = true;
    }

    public function render()
    {
        return view('livewire.product-order.show-product-order');
    }
}
