<?php

namespace App\Livewire\DailyExpense;

use App\Traits\DailyExpenseTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class UpdateDailyExpense extends Component
{
    use DailyExpenseTrait;

    #[On('edit-modal')]
    public function confirmEdit($id)
    {
        $this->reset();
        $this->resetValidation();
        $this->setDailyExpense($id);
        $this->edit_modal = true;
    }

    public function save()
    {
        $this->updateDailyExpense();
    }

    public function render()
    {
        return view('livewire.daily-expense.update-daily-expense');
    }
}
