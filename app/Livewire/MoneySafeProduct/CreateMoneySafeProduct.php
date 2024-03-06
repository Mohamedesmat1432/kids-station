<?php

namespace App\Livewire\MoneySafeProduct;

use App\Models\User;
use App\Traits\MoneySafeProductTrait;
use Livewire\Component;

class CreateMoneySafeProduct extends Component
{
    use MoneySafeProductTrait;

    public function save()
    {
        $this->authorize('create-money-safe-product');
        $this->storeMoneySafeProduct();
        $this->dispatch('refresh-list-money-safe-product');
        $this->successNotify(__('site.money_safe_product_created'));
    }

    public function render()
    {
        return view('livewire.money-safe-product.create-money-safe-product',[
            'users' => User::all()
        ]);
    }
}
