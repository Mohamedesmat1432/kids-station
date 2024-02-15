<?php

namespace App\Livewire\Order;

use App\Traits\OrderTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class RestoreOrder extends Component
{
    use OrderTrait;

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
        $this->authorize('restore-order');
        $this->restoreOrder($this->id);
        $this->dispatch('refresh-list-order');
        $this->successNotify(__('site.order_restored'));
        $this->restore_modal = false;
    }

    public function render()
    {
        return view('livewire.order.restore-order');
    }
}
