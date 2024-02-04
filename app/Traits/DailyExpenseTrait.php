<?php

namespace App\Traits;

use App\Models\DailyExpense;

trait DailyExpenseTrait
{
    use WithNotify;
    public ?DailyExpense $daily_expense;
    public $daily_expense_id;
    public $user_id;
    public $data;
    public $checkbox_arr = [];

    protected function rules()
    {
        return [
            'data.*.name' => 'required|string|min:2',
            'data.*.price' => 'required|numeric',
        ];
    }

    public function setDailyExpense($id)
    {
        $this->daily_expense = DailyExpense::findOrFail($id);
        $this->daily_expense_id = $this->daily_expense->id;
        $this->user_id = $this->daily_expense->user_id;
        $this->data = collect($this->daily_expense->data);
    }

    public function storeDailyExpense()
    {
        $validated = $this->validate();
        $validated['user_id'] = auth()->user()->id;
        DailyExpense::create($validated);
        $this->reset();
        $this->fillRow();
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

    public function updateDailyExpense()
    {
        $validated = $this->validate();
        $validated['user_id'] = auth()->user()->id;
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
        $data = DailyExpense::pluck('id')->toArray();
        $checkbox_count = count($this->checkbox_arr);

        if ($checkbox_count <= 1 || $checkbox_count < count($data)) {
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
}
