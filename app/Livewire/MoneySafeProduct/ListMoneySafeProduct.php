<?php

namespace App\Livewire\MoneySafeProduct;

use App\Traits\MoneySafeProductTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ListMoneySafeProduct extends Component
{
    use MoneySafeProductTrait;

    #[On('refresh-list-money-safe-product')]
    public function render()
    {
        $this->authorize('view-money-safe-product');

        $money_safe_products = $this->moneySafeProductList();

        return view('livewire.money-safe-product.list-money-safe-product', [
            'money_safe_products' => $money_safe_products,
        ]);
    }
}
