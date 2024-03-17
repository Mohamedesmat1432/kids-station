<?php

namespace App\Traits;

use App\Models\DailyExpense;
use App\Models\Order;
use App\Models\User;;

trait MoneySafeTrait
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

    public function showMoneySafe()
    {
        $this->validate();

        $order = Order::where('user_id', $this->user_id)
            ->whereDate('created_at', '>=', $this->start_date)
            ->whereDate('created_at', '<=', $this->end_date);

        $daily_expense = DailyExpense::where('user_id', $this->user_id)
            ->whereDate('created_at', '>=', $this->start_date)
            ->whereDate('created_at', '<=', $this->end_date);

        $user = User::findOrFail($this->user_id);

        $this->casher_name = $user->name;
        $this->total_order = $order->sum('total') - $order->sum('last_total');
        $this->total_daily_expense = $daily_expense->sum('total');
        $this->total = $this->total_order - $this->total_daily_expense;
        $this->dispatch('refresh-list-money-safe-kids');
    }
}
