<?php

namespace App\Livewire\Offer;

use App\Traits\OfferTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class ForceDeleteOffer extends Component
{
    use OfferTrait;

    #[Locked]
    public $id, $name;

    #[On('force-delete-modal')]
    public function confirmDelete($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->force_delete_modal = true;
    }

    public function delete()
    {
        $this->authorize('force-delete-offer');
        $this->forceDeleteOffer($this->id);
        $this->dispatch('refresh-list-offer');
        $this->successNotify(__('site.offer_deleted'));
        $this->force_delete_modal = false;
    }

    public function render()
    {
        return view('livewire.offer.force-delete-offer');
    }
}
