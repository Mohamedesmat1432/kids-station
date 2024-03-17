<?php

namespace App\Livewire\MoneySafe;

use App\Models\User;
use App\Traits\MoneySafeTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ListMoneySafe extends Component
{
    use MoneySafeTrait;

    #[On('refresh-list-money-safe-kids')]
    public function render()
    {
        return view('livewire.money-safe.list-money-safe', [
            'users' => User::get(['id','name'])
        ])->layout('layouts.app');
    }
}
