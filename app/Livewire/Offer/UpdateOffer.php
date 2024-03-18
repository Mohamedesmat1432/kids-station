<?php

namespace App\Livewire\Offer;

use App\Traits\OfferTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class UpdateOffer extends Component
{
    use OfferTrait;

    #[On('edit-modal')]
    public function confirmEdit($id)
    {
        $this->reset();
        $this->resetValidation();
        $this->setOffer($id);
        $this->edit_modal = true;
    }

    public function save()
    {
        $this->updateOffer();
    }

    public function render()
    {
        return view('livewire.offer.update-offer');
    }
}
