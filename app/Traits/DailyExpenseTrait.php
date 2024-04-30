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
    public $data = [['name' => '', 'price' => 0]];
    public $total;
    public $checkbox_arr = [];

    protected function rules()
    {
        return [
            'data.*.name' => 'required|string|min:2',
            'data.*.price' => 'required|numeric',
        ];
    }

    public function remove($key)
    {
        unset($this->data[$key]);
        $this->data = array_values($this->data);
    }

    public function add()
    {
        $this->data[] = ['name' => '', 'price' => 0];
    }

    public function totalPriceData($data)
    {
        return collect($data)->pluck('price')->sum();
    }

    public function storeDailyExpense()
    {
        $this->authorize('create-daily-expense-kids');
        $validated = $this->validate();
        $validated['user_id'] = auth()->user()->id;
        $validated['total'] = $this->totalPriceData($this->data);
        DailyExpense::create($validated);
        $this->reset();
        $this->dispatch('refresh-list-daily-expense-kids');
        $this->successNotify(__('site.daily_expense_created'));
        $this->create_modal = false;
    }

    public function setDailyExpense($id)
    {
        $this->daily_expense = DailyExpense::withoutTrashed()->findOrFail($id);
        $this->daily_expense_id = $this->daily_expense->id;
        $this->user_id = $this->daily_expense->user_id;
        $this->data = $this->daily_expense->data;
        $this->total = $this->daily_expense->total;
    }

    public function updateDailyExpense()
    {
        $this->authorize('edit-daily-expense-kids');
        $validated = $this->validate();
        $validated['user_id'] = auth()->user()->id;
        $validated['total'] = $this->totalPriceData($this->data);
        $this->daily_expense->update($validated);
        $this->reset();
        $this->dispatch('refresh-list-daily-expense-kids');
        $this->successNotify(__('site.daily_expense_updated'));
        $this->edit_modal = false;
    }

    public function deleteDailyExpense($id)
    {
        $this->authorize('delete-daily-expense-kids');
        $daily_expense = DailyExpense::withoutTrashed()->findOrFail($id);
        $daily_expense->delete();
        $this->reset();
        $this->dispatch('refresh-list-daily-expense-kids');
        $this->successNotify(__('site.daily_expense_deleted'));
        $this->delete_modal = false;
    }

    public function checkboxAll()
    {
        $daily_expenses_trashed = DailyExpense::onlyTrashed()->pluck('id')->toArray();
        $daily_expenses = DailyExpense::withoutTrashed()->pluck('id')->toArray();
        $checkbox_count = count($this->checkbox_arr);
        $data = $this->trash ? $daily_expenses_trashed : $daily_expenses;

        if ($checkbox_count < count($data)) {
            $this->checkbox_arr = $data;
        } else {
            $this->checkbox_arr = [];
        }
    }

    public function bulkDeleteDailyExpense($arr)
    {
        $this->authorize('bulk-delete-daily-expense-kids');
        $daily_expenses = DailyExpense::withoutTrashed()->whereIn('id', $arr);
        $daily_expenses->delete();
        $this->reset();
        $this->dispatch('refresh-list-daily-expense-kids');
        $this->dispatch('checkbox-clear');
        $this->successNotify(__('site.daily_expense_delete_all'));
        $this->bulk_delete_modal = false;
    }

    public function restoreDailyExpense($id)
    {
        $this->authorize('restore-daily-expense-kids');
        $daily_expense = DailyExpense::onlyTrashed()->findOrFail($id);
        $daily_expense->restore();
        $this->reset();
        $this->dispatch('refresh-list-daily-expense-kids');
        $this->successNotify(__('site.daily_expense_restored'));
        $this->restore_modal = false;
    }

    public function forceDeleteDailyExpense($id)
    {
        $this->authorize('force-delete-daily-expense-kids');
        $daily_expense = DailyExpense::onlyTrashed()->findOrFail($id);
        $daily_expense->forceDelete();
        $this->reset();
        $this->dispatch('refresh-list-daily-expense-kids');
        $this->successNotify(__('site.daily_expense_deleted'));
        $this->force_delete_modal = false;
    }

    public function forceBulkDeleteDailyExpense($arr)
    {
        $this->authorize('force-bulk-delete-daily-expense-kids');
        $daily_expenses = DailyExpense::onlyTrashed()->whereIn('id', $arr);
        $daily_expenses->forceDelete();
        $this->reset();
        $this->dispatch('refresh-list-daily-expense-kids');
        $this->dispatch('checkbox-clear');
        $this->successNotify(__('site.daily_expense_delete_all'));
        $this->force_bulk_delete_modal = false;
    }
}
