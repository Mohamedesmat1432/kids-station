<?php

namespace App\Livewire\DailyExpense;

use App\Traits\DailyExpenseTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class BulkDeleteDailyExpense extends Component
{
    use DailyExpenseTrait;
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
        $this->bulkDeleteDailyExpense($this->checkbox_arr);
    }

    public function render()
    {
        return view('livewire.daily-expense.bulk-delete-daily-expense');
    }
}
