<?php

namespace App\Livewire\Offer;

use App\Traits\OfferTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class RestoreOffer extends Component
{
    use OfferTrait;

    #[Locked]
    public $id, $name;

    #[On('restore-modal')]
    public function confirmRestore($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->restore_modal = true;
    }

    public function restore()
    {
        $this->authorize('restore-offer');
        $this->restoreOffer($this->id);
        $this->dispatch('refresh-list-offer');
        $this->successNotify(__('site.offer_restored'));
        $this->restore_modal = false;
    }
    
    public function render()
    {
        return view('livewire.offer.restore-offer');
    }
}
