<?php

namespace App\Livewire\DailyExpense;

use App\Traits\DailyExpenseTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class RestoreDailyExpense extends Component
{
    use DailyExpenseTrait;

    #[Locked]
    public $id, $name;

    #[On('restore-modal')]
    public function confirmRestore($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->restore_modal = true;
    }

    public function restore()
    {
        $this->authorize('restore-daily-expense-product');
        $this->restoreDailyExpense($this->id);
        $this->dispatch('restore-daily-expense-product');
        $this->successNotify(__('site.daily_expense_deleted'));
        $this->restore_modal = false;
    }

    public function render()
    {
        return view('livewire.daily-expense.restore-daily-expense');
    }
}
