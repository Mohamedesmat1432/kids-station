<?php

namespace App\Traits;

use App\Models\DailyExpense;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

trait DailyExpenseTrait
{
    use WithNotify, SortSearchTrait, WithPagination, ModalTrait, WithFileUploads;

    public ?DailyExpense $daily_expense;
    public $daily_expense_id;
    public $user_id;
    public $data;
    public $total;
    public $checkbox_arr = [];

    protected function rules()
    {
        return [
            'data.*.name' => 'required|string|min:2',
            'data.*.price' => 'required|numeric',
        ];
    }

    public function fillRow()
    {
        $this->data = collect([['name' => '', 'price' => 0]]);
    }

    public function remove($key)
    {
        $this->data->pull($key);
    }

    public function add()
    {
        $this->data->push(['name' => '', 'price' => 0]);
    }

    public function totalPriceData($data)
    {
        return collect($data)->pluck('price')->sum();
    }

    public function storeDailyExpense()
    {
        $validated = $this->validate();
        $validated['user_id'] = auth()->user()->id;
        $validated['total'] = $this->totalPriceData($this->data);
        DailyExpense::create($validated);
        $this->reset();
        $this->fillRow();
    }

    public function setDailyExpense($id)
    {
        $this->daily_expense = DailyExpense::findOrFail($id);
        $this->daily_expense_id = $this->daily_expense->id;
        $this->user_id = $this->daily_expense->user_id;
        $this->data = collect($this->daily_expense->data);
        $this->total = $this->daily_expense->total;
    }

    public function updateDailyExpense()
    {
        $validated = $this->validate();
        $validated['user_id'] = auth()->user()->id;
        $validated['total'] = $this->totalPriceData($this->data);
        $this->daily_expense->update($validated);
        $this->fillRow();
    }

    public function deleteDailyExpense($id)
    {
        $daily_expense = DailyExpense::findOrFail($id);
        $daily_expense->delete();
    }

    public function checkboxAll()
    {
        $daily_expenses_trashed = DailyExpense::onlyTrashed()->pluck('id')->toArray();
        $daily_expenses = DailyExpense::pluck('id')->toArray();
        $checkbox_count = count($this->checkbox_arr);
        $data = $this->trash ? $daily_expenses_trashed : $daily_expenses;

        if ($checkbox_count < count($data)) {
            $this->checkbox_arr = $data;
        } else {
            $this->checkbox_arr = [];
        }
    }

    public function bulkDeleteDailyExpense()
    {
        $daily_expenses = DailyExpense::whereIn('id', $this->checkbox_arr);
        $daily_expenses->delete();
    }

    public function dailyExpenseList()
    {
        return cache()->remember('daily_expenses', 1, function () {
            if (auth()->user()->hasRole(['Super Admin', 'Admin'])) {
                $daily_expenses = $this->trash 
                    ? DailyExpense::onlyTrashed() 
                    : DailyExpense::withoutTrashed();
            } else {
                $daily_expenses = $this->trash 
                    ? auth()->user()->dailyExpenses()->onlyTrashed() 
                    : auth()->user()->dailyExpenses()->withoutTrashed();
            }

            return $daily_expenses->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('price', 'like', '%' . $this->search . '%');
                });
            })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
                ->paginate($this->page_element);
        });
    }

    public function restoreDailyExpense($id)
    {
        $daily_expense = DailyExpense::onlyTrashed()->findOrFail($id);
        $daily_expense->restore();
    }

    public function forceDeleteDailyExpense($id)
    {
        $daily_expense = DailyExpense::onlyTrashed()->findOrFail($id);
        $daily_expense->forceDelete();
    }

    public function forceBulkDeleteDailyExpense()
    {
        $daily_expenses = DailyExpense::onlyTrashed()->whereIn('id', $this->checkbox_arr);
        $daily_expenses->forceDelete();
    }
}
