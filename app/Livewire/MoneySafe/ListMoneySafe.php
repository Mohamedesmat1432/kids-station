<?php

namespace App\Livewire\MoneySafe;

use App\Traits\MoneySafeTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ListMoneySafe extends Component
{
    use MoneySafeTrait;

    #[On('refresh-list-money-safe-kids')]
    public function render()
    {
        $this->authorize('view-money-safe-kids');

        return view('livewire.money-safe.list-money-safe', [
            'money_safes' => $this->moneySafeList(),
        ])->layout('layouts.app');
    }
}
