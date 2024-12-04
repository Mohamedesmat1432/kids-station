<?php

namespace App\Livewire\Order;

use App\Models\Offer;
use App\Models\Type;
use App\Traits\OrderTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class UpdateOrder extends Component
{
    use OrderTrait;

    #[On('edit-modal')]
    public function confirmEdit($id)
    {
        $this->reset();
        $this->resetValidation();
        $this->setOrder($id);
        $this->edit_modal = true;
    }

    public function save()
    {
        $this->updateOrder();
    }

    public function render()
    {
        $offers = Offer::active()->get();

        return view('livewire.order.update-order', [
            'type_durations' => $this->typeDuration(),
            'unique_types' => $this->uniqueTypes(),
            'offers' => $offers,
        ]);
    }
}
