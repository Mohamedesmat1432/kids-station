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
    use WithPagination, SortSearchTrait, DailyExpenseProductTrait;

    #[On('bulk-delete-clear')]
    public function checkboxClear()
    {
        $this->checkbox_arr = [];
    }

    #[On('create-daily-expense-product')]
    #[On('update-daily-expense-product')]
    #[On('delete-daily-expense-product')]
    #[On('import-daily-expense-product')]
    #[On('export-daily-expense-product')]
    #[On('bulk-delete-daily-expense-product')]
    public function render()
    {
        $this->authorize('view-daily-expense-product');

        $daily_expenses = cache()->remember('daily_expenses_product', 1, function () {
            return DailyExpenseProduct::when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('data', 'like', '%' . $this->search . '%');
                });
            })
                ->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
                ->paginate($this->page_element);
        });

        return view('livewire.daily-expense-product.list-daily-expense-product', [
            'daily_expenses' => $daily_expenses,
        ]);
    }
}
