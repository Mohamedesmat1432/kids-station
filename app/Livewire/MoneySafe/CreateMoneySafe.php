<?php

namespace App\Livewire\MoneySafe;

use App\Models\User;
use App\Traits\MoneySafeTrait;
use Livewire\Component;

class CreateMoneySafe extends Component
{
    use MoneySafeTrait;

    public function save()
    {
        $this->authorize('create-money-safe');
        $this->storeMoneySafe();
        $this->dispatch('refresh-list-money-safe');
        $this->successNotify(__('site.money_safe_created'));
    }
    
    public function render()
    {
        return view('livewire.money-safe.create-money-safe',[
            'users' => User::all()
        ]);
    }
}
