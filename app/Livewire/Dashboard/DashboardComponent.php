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
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Carbon\Carbon;

class DashboardComponent extends Component
{
    use WithPagination, SortSearchTrait;

    public $start_date = '';
    public $end_date = '';

    public function dashboardLinks()
    {
        return [
            [
                'name' => 'users',
                'value' => __('site.users'),
                'icon' => 'user-group',
                'role' => 'view-user',
                'bg' => 'bg-gray-500',
                'hover' => 'hover:bg-gray-600',
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
                'bg' => 'bg-blue-500',
                'hover' => 'hover:bg-blue-600',
                'count' => Category::count(),
                'total' => '',
            ],
            [
                'name' => 'units',
                'value' => __('site.units'),
                'icon' => 'currency-dollar',
                'role' => 'view-unit',
                'bg' => 'bg-green-500',
                'hover' => 'hover:bg-green-600',
                'count' => Unit::count(),
                'total' => '',
            ],
            [
                'name' => 'products',
                'value' => __('site.products'),
                'icon' => 'clipboard-document-check',
                'role' => 'view-product',
                'bg' => 'bg-red-500',
                'hover' => 'hover:bg-red-600',
                'count' => Product::count(),
                'total' => '',
            ],
            [
                'name' => 'offers',
                'value' => __('site.offers'),
                'icon' => 'gift',
                'role' => 'view-offer',
                'bg' => 'bg-yellow-600',
                'hover' => 'hover:bg-yellow-700',
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
                'count' => Order::countOrder(),
                'total' => Order::totalOrder(),
            ],
            [
                'name' => 'orders',
                'value' => __('site.attach_orders'),
                'icon' => 'briefcase',
                'role' => 'view-today-order-kids',
                'bg' => 'bg-gray-600',
                'hover' => 'hover:bg-gray-700',
                'count' => Order::countAttachOrder(),
                'total' => Order::totalAttachOrder(),
            ],
            [
                'name' => 'orders',
                'value' => __('site.today_orders'),
                'icon' => 'briefcase',
                'role' => 'view-today-order-kids',
                'bg' => 'bg-green-500',
                'hover' => 'hover:bg-green-600',
                'count' => Order::todayCountOrder(),
                'total' => Order::todayTotalOrder(),
            ],
            [
                'name' => 'orders',
                'value' => __('site.today_attach_orders'),
                'icon' => 'briefcase',
                'role' => 'view-today-order-kids',
                'bg' => 'bg-blue-600',
                'hover' => 'hover:bg-blue-700',
                'count' => Order::todayCountAttachOrder(),
                'total' => Order::todayTotalAttchOrder(),
            ],
            [
                'name' => 'orders',
                'value' => __('site.without_attach_orders'),
                'icon' => 'briefcase',
                'role' => 'view-today-order-kids',
                'bg' => 'bg-red-600',
                'hover' => 'hover:bg-red-700',
                'count' => Order::countWithoutAttachOrder(),
                'total' => Order::totalWithoutAttachOrder(),
            ],
            [
                'name' => 'orders',
                'value' => __('site.insurance'),
                'icon' => 'briefcase',
                'role' => 'view-today-order-kids',
                'bg' => 'bg-yellow-600',
                'hover' => 'hover:bg-yellow-700',
                'count' => Order::whereNot('insurance',0)->count(),
                'total' => Order::whereNot('insurance',0)->sum('insurance'),
            ],
            [
                'name' => 'product.orders',
                'value' => __('site.product_orders'),
                'icon' => 'briefcase',
                'role' => 'view-product-order',
                'bg' => 'bg-green-500',
                'hover' => 'hover:bg-green-600',
                'count' => ProductOrder::countProductOrder(),
                'total' => ProductOrder::totalProductOrder(),
            ],
            [
                'name' => 'daily.expenses',
                'value' => __('site.daily_expenses'),
                'icon' => 'briefcase',
                'role' => 'view-daily-expense-kids',
                'bg' => 'bg-gray-500',
                'hover' => 'hover:bg-gray-600',
                'count' => DailyExpense::countDailyExpense(),
                'total' => DailyExpense::totalDailyExpense(),
            ],
            [
                'name' => 'daily.expenses.product',
                'value' => __('site.daily_expenses_product'),
                'icon' => 'briefcase',
                'role' => 'view-daily-expense-product',
                'bg' => 'bg-red-500',
                'hover' => 'hover:bg-red-600',
                'count' => DailyExpenseProduct::countDailyExpenseProduct(),
                'total' => DailyExpenseProduct::totalDailyExpenseProduct(),
            ],
        ];
    }

    public function visitorsCount(){
        $data = [];
        
        $order_visitors = Order::whereDate('created_at','>=', $this->start_date)
            ->whereDate('created_at','<=', $this->end_date)->pluck('visitors')->toArray();

        foreach($order_visitors as $order_visitor){

            foreach($order_visitor as $visitor){
                array_push($data, Type::find($visitor['type_id'])->typeName->name);
            }
        }

        return array_count_values($data);
    }

    public function visitorsCountByDuration(){
        $data = [];
        
        $order_visitors = Order::whereDate('created_at','>=', $this->start_date)
            ->whereDate('created_at','<=', $this->end_date)->pluck('visitors')->toArray();

        $order_durations = Order::pluck('duration')->toArray();

        foreach($order_visitors as $key => $order_visitor){
            $duration = $order_durations[$key];

            foreach($order_visitor as $visitor){
                array_push($data, Type::find($visitor['type_id'])->typeName->name . ' ' . $duration);
            }
        }

        return array_count_values($data);
    }

    public function updateInsuranceTotalOrders() {
        return Order::whereNot('insurance',0)->whereDate('end_date','<=',Carbon::now())
        ->update(['insurance' => 0]);
    }

    public function render()
    {

        $orders_by_months = Order::orderByMonth($this->page_element);

        $product_orders_by_months = ProductOrder::productOrderByMonth($this->page_element);

        $daily_expenses_by_months = DailyExpense::dailyExpenseByMonth($this->page_element);

        $daily_expenses_product_by_months = DailyExpenseProduct::dailyExpenseProductByMonth($this->page_element);

            
        return view('livewire.dashboard.dashboard-component', [
            'dashboard_links' => $this->dashboardLinks(),
            'orders_by_months' => $orders_by_months,
            'product_orders_by_months' => $product_orders_by_months,
            'daily_expenses_by_months' => $daily_expenses_by_months,
            'daily_expenses_product_by_months' => $daily_expenses_product_by_months,
            'visitors_count' => $this->visitorsCount(),
            'visitors_count_by_duration' => $this->visitorsCountByDuration(),
        ]);
    }
}
