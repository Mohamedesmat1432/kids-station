<?php

namespace App\Livewire\Order;

use App\Models\Offer;
use App\Models\Type;
use App\Traits\OrderTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class AttachOrder extends Component
{
    use OrderTrait;

    #[On('attach-modal')]
    public function confirmAttach($id)
    {
        $this->reset();
        $this->resetValidation();
        $this->setOrder($id);
        $this->attach_modal = true;
    }

    public function save()
    {
        $this->attachOrder();
    }

    public function render()
    {
        $offers = Offer::active()->get();

        return view('livewire.order.attach-order', [
            'offers' => $offers,
        ]);
    }
}
