<?php

namespace App\Livewire\DailyExpenseProduct;

use App\Models\DailyExpenseProduct;
use App\Traits\DailyExpenseProductTrait;
use Livewire\Attributes\On;
use Livewire\Component;

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

        if (auth()->user()->hasRole(['Super Admin', 'Admin'])) {
            $daily_expenses = $this->trash 
                ? DailyExpenseProduct::onlyTrashed() 
                : DailyExpenseProduct::withoutTrashed();
        } else {
            $daily_expenses = $this->trash 
                ? auth()->user()->dailyExpenseProducts()->onlyTrashed() 
                : auth()->user()->dailyExpenseProducts()->withoutTrashed();
        }
        
        $daily_expenses = $daily_expenses->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
            ->search($this->search)->searchDate($this->date)->paginate($this->page_element);

        return view('livewire.daily-expense-product.list-daily-expense-product', [
            'daily_expenses' => $daily_expenses,
        ])->layout('layouts.app');
    }
}
