<?php

namespace App\Livewire\Order;

use App\Models\Offer;
use App\Models\Type;
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
        $this->create_exists_modal = true;
    }

    public function save()
    {
        $this->storeExistsOrder();
    }

    public function render()
    {
        $offers = Offer::active()->get();

        return view('livewire.order.create-exists-order',[
            'type_durations' => $this->typeDuration(),
            'unique_types' => $this->uniqueTypes(),
            'offers' => $offers,
        ]);
    }
}
