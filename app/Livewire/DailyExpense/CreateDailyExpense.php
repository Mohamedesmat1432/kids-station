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
        $this->fillRow();
        $this->create_modal = true;
    }

    public function save()
    {
        $this->authorize('create-daily-expense');
        $this->storeDailyExpense();
        $this->dispatch('refresh-list-daily-expense');
        $this->successNotify(__('site.daily_expense_created'));
        $this->create_modal = false;
    }

    public function render()
    {
        return view('livewire.daily-expense.create-daily-expense');
    }
}
