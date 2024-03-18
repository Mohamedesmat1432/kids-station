<?php

namespace App\Livewire\DailyExpenseProduct;

use App\Traits\DailyExpenseProductTrait;
use Livewire\Component;

class CreateDailyExpenseProduct extends Component
{
    use DailyExpenseProductTrait;

    public function createModal()
    {
        $this->reset();
        $this->resetValidation();
        $this->fillRow();
        $this->create_modal = true;
    }

    public function save()
    {
        $this->storeDailyExpense();
    }

    public function render()
    {
        return view('livewire.daily-expense-product.create-daily-expense-product');
    }
}
