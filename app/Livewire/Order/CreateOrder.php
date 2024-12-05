<?php

namespace App\Livewire\Order;

use App\Models\Offer;
use App\Models\Type;
use App\Traits\OrderTrait;
use Livewire\Component;

class CreateOrder extends Component
{
    use OrderTrait;

    public function createModal()
    {
        $this->reset();
        $this->resetValidation();
        $this->create_modal = true;
    }

    public function save()
    {
        $this->storeOrder();
    }

    public function render()
    {
        $offers = Offer::active()->get();

        return view('livewire.order.create-order', [
            'offers' => $offers,
        ]);
    }
}
