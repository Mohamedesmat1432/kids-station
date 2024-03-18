<?php

namespace App\Livewire\Offer;

use App\Traits\OfferTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ListOffer extends Component
{
    use OfferTrait;

    #[On('checkbox-clear')]
    public function checkboxClear()
    {
        $this->checkbox_arr = [];
    }

    #[On('refresh-list-offer')]
    public function render()
    {
        return view('livewire.offer.list-offer', [
            'offers' => $this->offerList(),
        ])->layout('layouts.app');
    }
}
