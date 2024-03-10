<?php

namespace App\Traits;

use App\Models\DailyExpenseProduct;
use App\Models\MoneySafeProduct;
use App\Models\ProductOrder;
use Livewire\WithPagination;

trait MoneySafeProductTrait
{
    use WithNotify, SortSearchTrait, WithPagination, ModalTrait;
    public ?MoneySafeProduct $money_safe;
    public $user_id;
    public $start_date;
    public $end_date;

    protected function rules()
    {
        return [
            'user_id' => 'required|numeric|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
        ];
    }

    public function storeMoneySafeProduct()
    {
        $validated = $this->validate();
        $product_orders = ProductOrder::where('user_id', '=', $this->user_id)->whereBetween('created_at', [$this->start_date, $this->end_date]);
        $daily_expense_products = DailyExpenseProduct::where('user_id', $this->user_id)->whereBetween('created_at', [$this->start_date, $this->end_date]);
        $validated['total_order'] = $product_orders->sum('total');
        $validated['total_daily_expense'] = $daily_expense_products->sum('total');
        $validated['total'] = $validated['total_order'] - $validated['total_daily_expense'];
        MoneySafeProduct::create($validated);
        $this->reset();
    }

    public function moneySafeProductList()
    {
        return cache()->remember('money_safe_products', 1, function () {
            $money_safe_products = auth()->user()->hasRole(['Super Admin', 'Admin'])
                ? new MoneySafeProduct()
                : auth()->user()->moneySafeProducts();

            return $money_safe_products->when($this->search, function ($query) {
                    return $query->where(function ($query) {
                        $query->where('date_now', 'like', '%' . $this->search . '%');
                    });
                })
                ->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
                ->paginate($this->page_element);
        });
    }
}
