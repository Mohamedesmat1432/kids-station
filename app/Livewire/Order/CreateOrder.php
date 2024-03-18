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
        $this->fillRow();
        $this->create_modal = true;
    }

    public function save()
    {
        $this->storeOrder();
    }

    public function render()
    {
        $type_durations = Type::active()->distinct()->whereNot('duration',0)->pluck('duration');
        $unique_types = Type::active()->whereIn('duration', [$this->duration, 0])->orderBy('price', 'ASC')->get();
        $offers = Offer::active()->get();

        return view('livewire.order.create-order', [
            'type_durations' => $type_durations,
            'unique_types' => $unique_types,
            'offers' => $offers,
        ]);
    }
}
