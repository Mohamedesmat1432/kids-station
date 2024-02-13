<?php

namespace App\Livewire\DailyExpenseProduct;

use App\Traits\DailyExpenseProductTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteDailyExpenseProduct extends Component
{
    use DailyExpenseProductTrait;

    #[Locked]
    public $id, $name;

    #[On('delete-modal')]
    public function confirmDelete($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->delete_modal = true;
    }

    public function delete()
    {
        $this->authorize('delete-daily-expense-product');
        $this->deleteDailyExpense($this->id);
        $this->dispatch('delete-daily-expense-product');
        $this->successNotify(__('site.daily_expense_deleted'));
        $this->reset();
        $this->delete_modal = false;
    }

    public function render()
    {
        return view('livewire.daily-expense-product.delete-daily-expense-product');
    }
}
