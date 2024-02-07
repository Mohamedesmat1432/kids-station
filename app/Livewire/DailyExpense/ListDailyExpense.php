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
    use WithPagination, SortSearchTrait, DailyExpenseTrait;

    #[On('bulk-delete-clear')]
    public function checkboxClear()
    {
        $this->checkbox_arr = [];
    }

    #[On('create-daily-expense')]
    #[On('update-daily-expense')]
    #[On('delete-daily-expense')]
    #[On('import-daily-expense')]
    #[On('export-daily-expense')]
    #[On('bulk-delete-daily-expense')]
    public function render()
    {
        $this->authorize('view-daily-expense');

        $daily_expenses = cache()->remember('daily_expenses', 1, function () {
            return DailyExpense::when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('data', 'like', '%' . $this->search . '%');
                });
            })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
                ->paginate($this->page_element);
        });

        return view('livewire.daily-expense.list-daily-expense', [
            'daily_expenses' => $daily_expenses,
        ]);
    }
}
