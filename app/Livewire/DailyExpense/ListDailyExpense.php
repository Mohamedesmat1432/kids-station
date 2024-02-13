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

    #[On('bulk-delete-clear')]
    #[On('force-bulk-delete-clear')]
    public function checkboxClear()
    {
        $this->checkbox_arr = [];
    }

    #[On('create-daily-expense')]
    #[On('update-daily-expense')]
    #[On('delete-daily-expense')]
    #[On('import-daily-expense')]
    #[On('export-daily-expense')]
    #[On('restore-daily-expense')]
    #[On('bulk-delete-daily-expense')]
    #[On('force-delete-daily-expense')]
    #[On('force-bulk-delete-daily-expense')]
    public function render()
    {
        $this->authorize('view-daily-expense');

        $daily_expenses = $this->dailyExpenseList();

        return view('livewire.daily-expense.list-daily-expense', [
            'daily_expenses' => $daily_expenses,
        ]);
    }
}
