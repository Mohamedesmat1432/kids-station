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

    #[On('checkbox-clear')]
    public function checkboxClear()
    {
        $this->checkbox_arr = [];
    }

    #[On('refresh-list-daily-expense-product')]
    public function render()
    {
        $this->authorize('view-daily-expense-product');

        $daily_expenses = $this->dailyExpenseList();

        return view('livewire.daily-expense-product.list-daily-expense-product', [
            'daily_expenses' => $daily_expenses,
        ]);
    }
}
