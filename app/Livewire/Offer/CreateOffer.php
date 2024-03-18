<?php

namespace App\Livewire\Offer;

use App\Traits\OfferTrait;
use Livewire\Component;

class CreateOffer extends Component
{
    use OfferTrait;

    public function createModal()
    {
        $this->reset();
        $this->resetValidation();
        $this->create_modal = true;
    }

    public function save()
    {
        $this->storeOffer();
    }

    public function render()
    {
        return view('livewire.offer.create-offer');
    }
}
