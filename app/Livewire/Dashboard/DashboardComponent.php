<?php

namespace App\Livewire\Dashboard;

use App\Models\Category;
use App\Models\DailyExpense;
use App\Models\DailyExpenseProduct;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\Role;
use App\Models\Type;
use App\Models\TypeName;
use App\Models\Unit;
use App\Models\User;
use App\Traits\SortSearchTrait;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class DashboardComponent extends Component
{
    use WithPagination, SortSearchTrait;

    public $start_date = '' ,$end_date = '';

    public function dashboardLinks()
    {
        return [
            [
                'name' => 'users',
                'value' => __('site.users'),
                'icon' => 'user-group',
                'role' => 'view-user',
                'bg' => 'bg-blue-500',
                'hover' => 'hover:bg-blue-600',
                'count' => User::count(),
                'total' => '',
            ],
            [
                'name' => 'roles',
                'value' => __('site.roles'),
                'icon' => 'lock-closed',
                'role' => 'view-role',
                'bg' => 'bg-green-500',
                'hover' => 'hover:bg-green-600',
                'count' => Role::count(),
                'total' => '',
            ],
            [
                'name' => 'categories',
                'value' => __('site.categories'),
                'icon' => 'rectangle-group',
                'role' => 'view-category',
                'bg' => 'bg-gray-500',
                'hover' => 'hover:bg-gray-600',
                'count' => Category::count(),
                'total' => '',
            ],
            [
                'name' => 'units',
                'value' => __('site.units'),
                'icon' => 'currency-dollar',
                'role' => 'view-unit',
                'bg' => 'bg-red-500',
                'hover' => 'hover:bg-red-600',
                'count' => Unit::count(),
                'total' => '',
            ],
            [
                'name' => 'products',
                'value' => __('site.products'),
                'icon' => 'clipboard-document-check',
                'role' => 'view-product',
                'bg' => 'bg-green-500',
                'hover' => 'hover:bg-green-600',
                'count' => Product::count(),
                'total' => '',
            ],
            [
                'name' => 'offers',
                'value' => __('site.offers'),
                'icon' => 'gift',
                'role' => 'view-offer',
                'bg' => 'bg-blue-500',
                'hover' => 'hover:bg-blue-600',
                'count' => Offer::count(),
                'total' => '',
            ],
            [
                'name' => 'type.names',
                'value' => __('site.type_names'),
                'icon' => 'clipboard-document-list',
                'role' => 'view-type-name',
                'bg' => 'bg-red-500',
                'hover' => 'hover:bg-red-600',
                'count' => TypeName::count(),
                'total' => '',
            ],
            [
                'name' => 'types',
                'value' => __('site.types'),
                'icon' => 'adjustments-horizontal',
                'role' => 'view-type',
                'bg' => 'bg-gray-500',
                'hover' => 'hover:bg-gray-600',
                'count' => Type::count(),
                'total' => '',
            ],
            [
                'name' => 'orders',
                'value' => __('site.orders'),
                'icon' => 'briefcase',
                'role' => 'view-order-kids',
                'bg' => 'bg-blue-500',
                'hover' => 'hover:bg-blue-600',
                'count' => auth()->user()->hasRole(['Super Admin', 'Admin'])
                    ? Order::count()
                    : auth()->user()->orders()->whereDate('created_at', Carbon::today())->count(),
                'total' => auth()->user()->hasRole(['Super Admin', 'Admin'])
                    ? Order::sum('total') - Order::sum('last_total')
                    : auth()->user()->orders()->whereDate('created_at', Carbon::today())->sum('total') - auth()->user()->orders()->whereDate('created_at', Carbon::today())->sum('last_total'),
            ],
            [
                'name' => 'orders',
                'value' => __('site.today_orders'),
                'icon' => 'briefcase',
                'role' => 'view-today-order-kids',
                'bg' => 'bg-blue-500',
                'hover' => 'hover:bg-blue-600',
                'count' => Order::whereDate('created_at', Carbon::today())->count(),
                'total' => Order::whereDate('created_at', Carbon::today())->sum('total') - Order::whereDate('created_at', Carbon::today())->sum('last_total'),
            ],
            [
                'name' => 'product.orders',
                'value' => __('site.product_orders'),
                'icon' => 'briefcase',
                'role' => 'view-product-order',
                'bg' => 'bg-green-500',
                'hover' => 'hover:bg-green-600',
                'count' => auth()->user()->hasRole(['Super Admin', 'Admin'])
                    ? ProductOrder::count()
                    : auth()->user()->productOrders()->whereDate('created_at', Carbon::today())->count(),
                'total' => auth()->user()->hasRole(['Super Admin', 'Admin'])
                    ? ProductOrder::sum('total')
                    : auth()->user()->productOrders()->whereDate('created_at', Carbon::today())->sum('total'),
            ],
            [
                'name' => 'daily.expenses',
                'value' => __('site.daily_expenses'),
                'icon' => 'briefcase',
                'role' => 'view-daily-expense-kids',
                'bg' => 'bg-gray-500',
                'hover' => 'hover:bg-gray-600',
                'count' => auth()->user()->hasRole(['Super Admin', 'Admin'])
                    ? DailyExpense::count()
                    : auth()->user()->dailyExpenses()->whereDate('created_at', Carbon::today())->count(),
                'total' => auth()->user()->hasRole(['Super Admin', 'Admin'])
                    ? DailyExpense::sum('total')
                    : auth()->user()->dailyExpenses()->whereDate('created_at', Carbon::today())->sum('total'),
            ],
            [
                'name' => 'daily.expenses.product',
                'value' => __('site.daily_expenses_product'),
                'icon' => 'briefcase',
                'role' => 'view-daily-expense-product',
                'bg' => 'bg-red-500',
                'hover' => 'hover:bg-red-600',
                'count' => auth()->user()->hasRole(['Super Admin', 'Admin'])
                    ? DailyExpenseProduct::count()
                    : auth()->user()->dailyExpenseProducts()->whereDate('created_at', Carbon::today())->count(),
                'total' => auth()->user()->hasRole(['Super Admin', 'Admin'])
                    ? DailyExpenseProduct::sum('total')
                    : auth()->user()->dailyExpenseProducts()->whereDate('created_at', Carbon::today())->sum('total'),
            ],
        ];
    }

    public function visitorsCount(){
        $data = [];
        $order_visitors = Order::whereDate('created_at','>=',$this->start_date)
            ->whereDate('created_at','<=',$this->end_date)->pluck('visitors')->toArray();

        foreach($order_visitors as $order_visitor){
            foreach($order_visitor as $visitor){
                array_push($data,Type::find($visitor['type_id'])->typeName->name);
            }
        }

        return array_count_values($data);
    }

    public function render()
    {

        $orders_by_months = Order::select(DB::raw('sum(total) as total'), DB::raw('sum(last_total) as last_total'), DB::raw("DATE_FORMAT(created_at,'%M %Y') as months"))
            ->groupBy('months')->paginate($this->page_element);

        $product_orders_by_months = ProductOrder::select(DB::raw('sum(total) as total'), DB::raw("DATE_FORMAT(created_at,'%M %Y') as months"))
            ->groupBy('months')->paginate($this->page_element);

        $daily_expenses_by_months = DailyExpense::select(DB::raw('sum(total) as total'), DB::raw("DATE_FORMAT(created_at,'%M %Y') as months"))
            ->groupBy('months')->paginate($this->page_element);

        $daily_expenses_product_by_months = DailyExpenseProduct::select(DB::raw('sum(total) as total'), DB::raw("DATE_FORMAT(created_at,'%M %Y') as months"))
            ->groupBy('months')->paginate($this->page_element);

            
        return view('livewire.dashboard.dashboard-component', [
            'dashboard_links' => $this->dashboardLinks(),
            'orders_by_months' => $orders_by_months,
            'product_orders_by_months' => $product_orders_by_months,
            'daily_expenses_by_months' => $daily_expenses_by_months,
            'daily_expenses_product_by_months' => $daily_expenses_product_by_months,
            'visitors_count' => $this->visitorsCount(),
        ]);
    }
}
