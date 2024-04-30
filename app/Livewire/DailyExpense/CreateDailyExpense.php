<?php

namespace App\Livewire\DailyExpense;

use App\Traits\DailyExpenseTrait;
use Livewire\Component;

class CreateDailyExpense extends Component
{
    use DailyExpenseTrait;

    public function createModal()
    {
        $this->reset();
        $this->resetValidation();
        $this->create_modal = true;
    }

    public function save()
    {
        $this->storeDailyExpense();
    }

    public function render()
    {
        return view('livewire.daily-expense.create-daily-expense');
    }
}
