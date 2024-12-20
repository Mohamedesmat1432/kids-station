<?php

namespace App\Traits;

use App\Models\DailyExpenseProduct;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

trait DailyExpenseProductTrait
{
    use WithNotify, SortSearchTrait, WithPagination, ModalTrait, WithFileUploads;

    public ?DailyExpenseProduct $daily_expense;
    public $daily_expense_id;
    public $user_id;
    public $data = [['name' => '', 'price' => 0]];
    public $total;

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
        $this->authorize('create-daily-expense-product');
        $validated = $this->validate();
        $validated['user_id'] = auth()->user()->id;
        $validated['total'] = $this->totalPriceData($this->data);
        DailyExpenseProduct::create($validated);
        $this->reset();
        $this->dispatch('refresh-list-daily-expense-product');
        $this->successNotify(__('site.daily_expense_created'));
        $this->create_modal = false;
    }

    public function setDailyExpense($id)
    {
        $this->daily_expense = DailyExpenseProduct::withoutTrashed()->findOrFail($id);
        $this->daily_expense_id = $this->daily_expense->id;
        $this->user_id = $this->daily_expense->user_id;
        $this->data = $this->daily_expense->data;
        $this->total = $this->daily_expense->total;
    }

    public function updateDailyExpense()
    {
        $this->authorize('edit-daily-expense-product');
        $validated = $this->validate();
        $validated['user_id'] = auth()->user()->id;
        $validated['total'] = $this->totalPriceData($this->data);
        $this->daily_expense->update($validated);
        $this->reset();
        $this->dispatch('refresh-list-daily-expense-product');
        $this->successNotify(__('site.daily_expense_updated'));
        $this->edit_modal = false;
    }

    public function deleteDailyExpense($id)
    {
        $this->authorize('delete-daily-expense-product');
        $daily_expense = DailyExpenseProduct::withoutTrashed()->findOrFail($id);
        $daily_expense->delete();
        $this->reset();
        $this->dispatch('refresh-list-daily-expense-product');
        $this->successNotify(__('site.daily_expense_deleted'));
        $this->delete_modal = false;
    }
    
    public function bulkDeleteDailyExpense($arr)
    {
        $this->authorize('bulk-delete-daily-expense-product');
        $daily_expenses = DailyExpenseProduct::withoutTrashed()->whereIn('id', $arr);
        $daily_expenses->delete();
        $this->reset();
        $this->dispatch('refresh-list-daily-expense-product');
        $this->dispatch('checkbox-clear');
        $this->successNotify(__('site.daily_expense_delete_all'));
        $this->bulk_delete_modal = false;
    }

    public function restoreDailyExpense($id)
    {
        $this->authorize('restore-daily-expense-product');
        $daily_expense = DailyExpenseProduct::onlyTrashed()->findOrFail($id);
        $daily_expense->restore();
        $this->reset();
        $this->dispatch('refresh-list-daily-expense-product');
        $this->successNotify(__('site.daily_expense_restored'));
        $this->restore_modal = false;
    }

    public function forceDeleteDailyExpense($id)
    {
        $this->authorize('force-delete-daily-expense-product');
        $daily_expense = DailyExpenseProduct::onlyTrashed()->findOrFail($id);
        $daily_expense->forceDelete();
        $this->reset();
        $this->dispatch('refresh-list-daily-expense-product');
        $this->successNotify(__('site.daily_expense_deleted'));
        $this->force_delete_modal = false;
    }

    public function forceBulkDeleteDailyExpense($arr)
    {
        $this->authorize('force-bulk-delete-daily-expense-product');
        $daily_expenses = DailyExpenseProduct::onlyTrashed()->whereIn('id', $arr);
        $daily_expenses->forceDelete();
        $this->reset();
        $this->dispatch('refresh-list-daily-expense-product');
        $this->dispatch('checkbox-clear');
        $this->successNotify(__('site.daily_expense_delete_all'));
        $this->force_bulk_delete_modal = false;
    }
}
