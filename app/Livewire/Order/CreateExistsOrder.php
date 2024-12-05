<?php

namespace App\Livewire\Order;

use App\Models\Offer;
use App\Traits\OrderTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class CreateExistsOrder extends Component
{
    use OrderTrait;

    #[On('create-exists-modal')]
    public function confirmCreateExists($id)
    {
        $this->reset();
        $this->resetValidation();
        $this->setOrder($id);
        $this->totalVisitors();
        $this->create_exists_modal = true;
    }

    public function save()
    {
        $this->storeExistsOrder();
    }

    // #[On('refresh-list-order-kids')]
    public function render()
    {
        $offers = Offer::active()->get();

        return view('livewire.order.create-exists-order',[
            'offers' => $offers,
        ]);
    }
}
