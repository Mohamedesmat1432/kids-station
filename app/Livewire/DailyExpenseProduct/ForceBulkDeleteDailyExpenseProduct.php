<?php

namespace App\Livewire\DailyExpenseProduct;

use App\Traits\DailyExpenseProductTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ForceBulkDeleteDailyExpenseProduct extends Component
{
    use DailyExpenseProductTrait;

    public $count;

    #[On('force-bulk-delete-modal')]
    public function confirmDelete($arr)
    {
        $this->checkbox_arr = json_decode($arr);
        $this->count = count($this->checkbox_arr);
        $this->force_bulk_delete_modal = true;
    }

    public function delete()
    {
        $this->authorize('force-bulk-delete-daily-expense-product');
        $this->forceBulkDeleteDailyExpense();
        $this->dispatch('force-bulk-delete-daily-expense-product');
        $this->dispatch('force-bulk-delete-clear');
        $this->successNotify(__('site.daily_expense_delete_all'));
        $this->force_bulk_delete_modal = false;
    }

    public function render()
    {
        return view('livewire.daily-expense-product.force-bulk-delete-daily-expense-product');
    }
}
