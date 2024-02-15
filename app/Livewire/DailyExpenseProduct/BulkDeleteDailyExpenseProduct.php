<?php

namespace App\Livewire\DailyExpenseProduct;

use App\Traits\DailyExpenseProductTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class BulkDeleteDailyExpenseProduct extends Component
{
    use DailyExpenseProductTrait;
    public $count;

    #[On('bulk-delete-modal')]
    public function confirmDelete($arr)
    {
        $this->checkbox_arr = json_decode($arr);
        $this->count = count($this->checkbox_arr);
        $this->bulk_delete_modal = true;
    }

    public function delete()
    {
        $this->authorize('bulk-delete-daily-expense-product');
        $this->bulkDeleteDailyExpense();
        $this->dispatch('refresh-list-daily-expense-product');
        $this->dispatch('checkbox-clear');
        $this->successNotify(__('site.daily_expense_delete_all'));
        $this->bulk_delete_modal = false;
    }

    public function render()
    {
        return view('livewire.daily-expense-product.bulk-delete-daily-expense-product');
    }
}
