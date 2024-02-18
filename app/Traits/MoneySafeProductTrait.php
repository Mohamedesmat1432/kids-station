<?php

namespace App\Traits;

use App\Models\DailyExpenseProduct;
use App\Models\MoneySafe;
use App\Models\MoneySafeProduct;
use App\Models\ProductOrder;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

trait MoneySafeProductTrait
{
    use WithNotify;
    use SortSearchTrait;
    use WithPagination;
    use ModalTrait;
    use WithFileUploads;
    public ?MoneySafeProduct $money_safe;
    public $user_id;
    public $date_now;

    protected function rules()
    {
        return [
            'user_id' => 'required|numeric|exists:users,id',
            'date_now' => 'required|date',
        ];
    }

    public function storeMoneySafeProduct()
    {
        $validated = $this->validate();
        $product_orders = ProductOrder::where('user_id','=',$this->user_id)->whereDate('created_at','=',$this->date_now);
        $daily_expense_products =  DailyExpenseProduct::where('user_id',$this->user_id)->whereDate('created_at',$this->date_now);
        $validated['total_order'] = $product_orders->sum('total');
        $validated['total_daily_expense'] = $daily_expense_products->sum('total');
        $validated['total'] = $validated['total_order'] - $validated['total_daily_expense'];
        MoneySafeProduct::create($validated);
        $this->reset();
    }

    public function moneySafeProductList()
    {
        return cache()->remember('money_safe_products', 1, function () {
            return MoneySafeProduct::when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('date_now', 'like', '%' . $this->search . '%');
                });
            })
                ->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
                ->paginate($this->page_element);
        });
    }
}
