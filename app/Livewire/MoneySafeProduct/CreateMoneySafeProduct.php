<?php

namespace App\Livewire\MoneySafeProduct;

use App\Models\User;
use App\Traits\MoneySafeProductTrait;
use Livewire\Component;

class CreateMoneySafeProduct extends Component
{
    use MoneySafeProductTrait;

    public function createModal()
    {
        $this->reset();
        $this->resetValidation();
        $this->create_modal = true;
    }

    public function save()
    {
        $this->authorize('create-money-safe-product');
        $this->storeMoneySafeProduct();
        $this->dispatch('refresh-list-money-safe-product');
        $this->successNotify(__('site.money_safe_product_created'));
        $this->create_modal = false;
    }

    public function render()
    {
        return view('livewire.money-safe-product.create-money-safe-product',[
            'users' => User::all()
        ]);
    }
}
