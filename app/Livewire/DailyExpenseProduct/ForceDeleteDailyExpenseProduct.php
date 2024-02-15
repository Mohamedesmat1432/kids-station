<?php

namespace App\Livewire\DailyExpenseProduct;

use App\Traits\DailyExpenseProductTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class ForceDeleteDailyExpenseProduct extends Component
{
    use DailyExpenseProductTrait;

    #[Locked]
    public $id, $name;

    #[On('force-delete-modal')]
    public function confirmDelete($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->force_delete_modal = true;
    }

    public function delete()
    {
        $this->authorize('force-delete-daily-expense-product');
        $this->forceDeleteDailyExpense($this->id);
        $this->dispatch('refresh-list-daily-expense-product');
        $this->successNotify(__('site.daily_expense_deleted'));
        $this->force_delete_modal = false;
    }

    public function render()
    {
        return view('livewire.daily-expense-product.force-delete-daily-expense-product');
    }
}
