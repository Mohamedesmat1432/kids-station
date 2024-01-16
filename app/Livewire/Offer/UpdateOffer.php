<?php

namespace App\Livewire\Offer;

use App\Traits\OfferTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class UpdateOffer extends Component
{
    use OfferTrait;
    public $edit_modal = false;

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
        $this->authorize('edit-offer');
        $this->updateOffer();
        $this->dispatch('update-offer');
        $this->successNotify(__('site.offer_updated'));
        $this->edit_modal = false;
    }

    public function render()
    {
        return view('livewire.offer.update-offer');
    }
}
