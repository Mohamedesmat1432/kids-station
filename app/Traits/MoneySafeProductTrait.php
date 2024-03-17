<?php

namespace App\Traits;

use App\Models\DailyExpenseProduct;
use App\Models\ProductOrder;
use App\Models\User;

trait MoneySafeProductTrait
{
    use WithNotify;
    public $user_id;
    public $start_date;
    public $end_date;
    public $casher_name;
    public $total_order;
    public $total_daily_expense;
    public $total;

    protected function rules()
    {
        return [
            'user_id' => 'required|numeric|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
        ];
    }

    public function showMoneySafeProduct()
    {
        $this->validate();

        $product_orders = ProductOrder::where('user_id', $this->user_id)
            ->whereDate('created_at', '>=', $this->start_date)
            ->whereDate('created_at', '<=', $this->end_date);

        $daily_expense_products = DailyExpenseProduct::where('user_id', $this->user_id)
            ->whereDate('created_at', '>=', $this->start_date)
            ->whereDate('created_at', '<=', $this->end_date);

        $user = User::findOrFail($this->user_id);

        $this->casher_name = $user->name;
        $this->total_order = $product_orders->sum('total');
        $this->total_daily_expense = $daily_expense_products->sum('total');
        $this->total = $this->total_order - $this->total_daily_expense;

        $this->dispatch('refresh-list-money-safe-product');
    }
}
