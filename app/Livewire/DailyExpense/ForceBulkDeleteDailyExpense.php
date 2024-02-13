<?php

namespace App\Livewire\DailyExpense;

use App\Traits\DailyExpenseTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ForceBulkDeleteDailyExpense extends Component
{
    use DailyExpenseTrait;

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
        $this->authorize('force-bulk-delete-daily-expense');
        $this->forceBulkDeleteDailyExpense();
        $this->dispatch('force-bulk-delete-daily-expense');
        $this->dispatch('force-bulk-delete-clear');
        $this->successNotify(__('site.daily_expense_delete_all'));
        $this->force_bulk_delete_modal = false;
    }
    
    public function render()
    {
        return view('livewire.daily-expense.force-bulk-delete-daily-expense');
    }
}
