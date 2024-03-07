<?php

namespace App\Livewire\DailyExpense;

use App\Models\DailyExpense;
use App\Traits\DailyExpenseTrait;
use App\Traits\SortSearchTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListDailyExpense extends Component
{
    use DailyExpenseTrait;

    #[On('checkbox-clear')]
    public function checkboxClear()
    {
        $this->checkbox_arr = [];
    }

    #[On('refresh-list-daily-expense-kids')]
    public function render()
    {
        $this->authorize('view-daily-expense-kids');

        return view('livewire.daily-expense.list-daily-expense', [
            'daily_expenses' => $this->dailyExpenseList(),
        ])->layout('layouts.app');
    }
}
