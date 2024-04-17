<?php

namespace App\Livewire\ProductOrder;

use App\Traits\ProductOrderTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowProductOrder extends Component
{
    use ProductOrderTrait;

    #[On('show-modal')]
    public function showModal($id)
    {
        $this->showProductOrder($id);
        $this->show_modal = true;
    }

    public function render()
    {
        return view('livewire.product-order.show-product-order');
    }
}
