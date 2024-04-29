<?php

namespace App\Traits;

use App\Models\DailyExpense;
use App\Models\Order;
use App\Models\User;;

trait MoneySafeTrait
{
    use WithNotify;

    public $user_ids = [];
    public $start_date;
    public $end_date;
    public $total_order;
    public $total_daily_expense;
    public $total;

    protected function rules()
    {
        return [
            'user_ids' => 'required|array',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
        ];
    }

    public function showMoneySafe()
    {
        $this->validate();

        $order = Order::whereIn('user_id', $this->user_ids)
            ->whereDate('created_at', '>=', $this->start_date)
            ->whereDate('created_at', '<=', $this->end_date);

        $daily_expense = DailyExpense::whereIn('user_id', $this->user_ids)
            ->whereDate('created_at', '>=', $this->start_date)
            ->whereDate('created_at', '<=', $this->end_date);

        $this->total_order = $order->sum('total') - $order->sum('last_total');
        $this->total_daily_expense = $daily_expense->sum('total');
        $this->total = $this->total_order - $this->total_daily_expense;
        $this->dispatch('refresh-list-money-safe-kids');
    }
}
