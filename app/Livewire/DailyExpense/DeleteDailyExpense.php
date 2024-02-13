<?php

namespace App\Livewire\DailyExpense;

use App\Traits\DailyExpenseTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteDailyExpense extends Component
{
    use DailyExpenseTrait;

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
        $this->authorize('delete-daily-expense');
        $this->deleteDailyExpense($this->id);
        $this->dispatch('delete-daily-expense');
        $this->successNotify(__('site.daily_expense_deleted'));
        $this->reset();
        $this->delete_modal = false;
    }
    
    public function render()
    {
        return view('livewire.daily-expense.delete-daily-expense');
    }
}
