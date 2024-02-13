<?php

namespace App\Livewire\DailyExpenseProduct;

use App\Models\DailyExpenseProduct;
use App\Traits\DailyExpenseProductTrait;
use App\Traits\SortSearchTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListDailyExpenseProduct extends Component
{
    use DailyExpenseProductTrait;

    #[On('bulk-delete-clear')]
    #[On('force-bulk-delete-clear')]
    public function checkboxClear()
    {
        $this->checkbox_arr = [];
    }

    #[On('create-daily-expense-product')]
    #[On('update-daily-expense-product')]
    #[On('delete-daily-expense-product')]
    #[On('import-daily-expense-product')]
    #[On('export-daily-expense-product')]
    #[On('restore-daily-expense-product')]
    #[On('bulk-delete-daily-expense-product')]
    #[On('force-delete-daily-expense-product')]
    #[On('force-bulk-delete-daily-expense-product')]
    public function render()
    {
        $this->authorize('view-daily-expense-product');

        $daily_expenses = $this->dailyExpenseList();

        return view('livewire.daily-expense-product.list-daily-expense-product', [
            'daily_expenses' => $daily_expenses,
        ]);
    }
}
