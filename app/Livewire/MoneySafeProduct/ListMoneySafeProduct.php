<?php

namespace App\Livewire\MoneySafeProduct;

use App\Models\User;
use App\Traits\MoneySafeProductTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ListMoneySafeProduct extends Component
{
    use MoneySafeProductTrait;

    #[On('refresh-list-money-safe-product')]
    public function render()
    {
        return view('livewire.money-safe-product.list-money-safe-product', [
            'users' => User::get(['id','name'])
        ])->layout('layouts.app');
    }
}
