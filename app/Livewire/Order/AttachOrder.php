<?php

namespace App\Livewire\Order;

use App\Models\Offer;
use App\Models\Type;
use App\Traits\OrderTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class AttachOrder extends Component
{
    use OrderTrait;

    #[On('attach-modal')]
    public function confirmAttach($id)
    {
        $this->reset();
        $this->resetValidation();
        $this->setOrder($id);
        $this->attach_modal = true;
    }

    public function save()
    {
        $this->authorize('attach-order');
        $this->AttachOrder();
        $this->dispatch('refresh-list-order');
        $this->successNotify(__('site.order_updated'));
        $this->attach_modal = false;
    }

    public function render()
    {
        $type_durations = cache()->remember('type_durations', 1, function () {
            return Type::active()->distinct()->whereNot('duration', 0)->pluck('duration');
        });

        $offers = cache()->remember('offres', 1, function () {
            return Offer::active()->get();
        });

        return view('livewire.order.attach-order', [
            'type_durations' => $type_durations,
            'offers' => $offers,
        ]);
    }
}
