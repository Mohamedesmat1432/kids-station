<?php

namespace App\Livewire\DailyExpense;

use App\Models\DailyExpense;
use App\Traits\DailyExpenseTrait;
use Livewire\Attributes\On;
use Livewire\Component;

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

        if (auth()->user()->hasRole(['Super Admin', 'Admin'])) {
            $daily_expenses = $this->trash 
                ? DailyExpense::onlyTrashed() 
                : DailyExpense::withoutTrashed();
        } else {
            $daily_expenses = $this->trash 
                ? auth()->user()->dailyExpenses()->onlyTrashed() 
                : auth()->user()->dailyExpenses()->withoutTrashed();
        }

        $daily_expenses = $daily_expenses->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
            ->search($this->search)->paginate($this->page_element);

        return view('livewire.daily-expense.list-daily-expense', [
            'daily_expenses' => $daily_expenses,
        ]);
    }
}
