<?php

namespace App\Livewire\DailyExpenseProduct;

use App\Traits\DailyExpenseProductTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class UpdateDailyExpenseProduct extends Component
{
    use DailyExpenseProductTrait;

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
        return view('livewire.daily-expense-product.update-daily-expense-product');
    }
}
