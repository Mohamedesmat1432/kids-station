<?php

namespace App\Livewire\DailyExpense;

use App\Traits\DailyExpenseTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class ForceDeleteDailyExpense extends Component
{
    use DailyExpenseTrait;

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
        $this->authorize('force-delete-daily-expense');
        $this->forceDeleteDailyExpense($this->id);
        $this->dispatch('refresh-list-daily-expense');
        $this->successNotify(__('site.daily_expense_deleted'));
        $this->force_delete_modal = false;
    }
    public function render()
    {
        return view('livewire.daily-expense.force-delete-daily-expense');
    }
}
