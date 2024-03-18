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
        $this->forceDeleteDailyExpense($this->id);
    }

    public function render()
    {
        return view('livewire.daily-expense-product.force-delete-daily-expense-product');
    }
}
