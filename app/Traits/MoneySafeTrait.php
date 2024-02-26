<?php

namespace App\Traits;

use App\Models\DailyExpense;
use App\Models\MoneySafe;
use App\Models\Order;
use App\Models\User;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

trait MoneySafeTrait
{
    use WithNotify;
    use SortSearchTrait;
    use WithPagination;
    use ModalTrait;
    use WithFileUploads;
    public ?MoneySafe $money_safe;
    public $user_id;
    public $date_now;

    protected function rules()
    {
        return [
            'user_id' => 'required|numeric|exists:users,id',
            'date_now' => 'required|date',
        ];
    }

    public function storeMoneySafe()
    {
        $validated = $this->validate();
        $order = Order::where('user_id','=',$this->user_id)->whereDate('created_at','=',$this->date_now);
        $daily_expense =  DailyExpense::where('user_id',$this->user_id)->whereDate('created_at',$this->date_now);
        $validated['total_order'] = $order->sum('total')  - $order->sum('last_total');
        $validated['total_daily_expense'] = $daily_expense->sum('total');
        $validated['total'] = $validated['total_order'] - $validated['total_daily_expense'];
        MoneySafe::create($validated);
        $this->reset();
    }

    public function moneySafeList()
    {
        return cache()->remember('money_safes', 1, function () {
            if (auth()->user()->hasRole(['Super Admin', 'Admin'])) {
                $money_safes = new MoneySafe();
            } else {
                $money_safes = auth()->user()->moneySafes();
            }
            
            return $money_safes->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('date_now', 'like', '%' . $this->search . '%');
                });
            })
                ->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
                ->paginate($this->page_element);
        });
    }
}
