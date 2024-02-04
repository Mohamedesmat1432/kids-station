<?php

namespace App\Livewire\Offer;

use App\Traits\OfferTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteOffer extends Component
{
    use OfferTrait;
    public $delete_modal = false;

    #[Locked]
    public $id, $name;

    #[On('delete-modal')]
    public function confirmDelete($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->delete_modal = true;
    }

    public function delete()
    {
        $this->authorize('delete-offer');
        $this->deleteOffer($this->id);
        $this->dispatch('delete-offer');
        $this->successNotify(__('site.offer_deleted'));
        $this->reset();
        $this->delete_modal = false;
    }

    public function render()
    {
        return view('livewire.offer.delete-offer');
    }
}
