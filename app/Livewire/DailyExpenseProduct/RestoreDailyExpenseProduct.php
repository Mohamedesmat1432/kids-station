<?php

namespace App\Livewire\DailyExpenseProduct;

use App\Traits\DailyExpenseProductTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class RestoreDailyExpenseProduct extends Component
{
    use DailyExpenseProductTrait;

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
        $this->successNotify(__('site.daily_expense_restored'));
        $this->restore_modal = false;
    }

    public function render()
    {
        return view('livewire.daily-expense-product.restore-daily-expense-product');
    }
}
