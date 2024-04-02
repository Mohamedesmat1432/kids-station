<?php

namespace App\Livewire\Dashboard;

use App\Models\Category;
use App\Models\DailyExpense;
use App\Models\DailyExpenseProduct;
use App\Models\MoneySafe;
use App\Models\MoneySafeProduct;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Permission;
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

class DashboardComponent extends Component
{
    use WithPagination, SortSearchTrait;
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
            // [
            //     'name' => 'permissions',
            //     'value' => __('site.permissions'),
            //     'icon' => 'receipt-percent',
            //     'role' => 'view-permission',
            //     'bg' => 'bg-red-500',
            //     'hover' => 'hover:bg-red-600',
            //     'count' => Permission::count(),
            // 'total' => '',
            // ],
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
                'count' => Order::count(),
                'total' => Order::sum('total') - Order::sum('last_total'),
            ],
            [
                'name' => 'product.orders',
                'value' => __('site.product_orders'),
                'icon' => 'briefcase',
                'role' => 'view-product-order',
                'bg' => 'bg-green-500',
                'hover' => 'hover:bg-green-600',
                'count' => ProductOrder::count(),
                'total' => ProductOrder::sum('total'),
            ],
            [
                'name' => 'daily.expenses',
                'value' => __('site.daily_expenses'),
                'icon' => 'briefcase',
                'role' => 'view-daily-expense-kids',
                'bg' => 'bg-gray-500',
                'hover' => 'hover:bg-gray-600',
                'count' => DailyExpense::count(),
                'total' => DailyExpense::sum('total'),
            ],
            [
                'name' => 'daily.expenses.product',
                'value' => __('site.daily_expenses_product'),
                'icon' => 'briefcase',
                'role' => 'view-daily-expense-product',
                'bg' => 'bg-red-500',
                'hover' => 'hover:bg-red-600',
                'count' => DailyExpenseProduct::count(),
                'total' => DailyExpenseProduct::sum('total'),
            ],
        ];
    }

    public function render()
    {
        $orders_by_months = Order::select(DB::raw('sum(total) as total'), DB::raw('sum(last_total) as last_total'), DB::raw("DATE_FORMAT(created_at,'%M %Y') as months"))
            ->groupBy('months')->paginate($this->page_element);

        $product_orders_by_months = ProductOrder::select(DB::raw('sum(total) as total'), DB::raw("DATE_FORMAT(created_at,'%M %Y') as months"))
            ->groupBy('months')->paginate($this->page_element);

        $daily_expenses = DailyExpense::select(DB::raw('sum(total) as total'), DB::raw("DATE_FORMAT(created_at,'%M %Y') as months"))
            ->groupBy('months')->paginate($this->page_element);

        $daily_expenses_product = DailyExpenseProduct::select(DB::raw('sum(total) as total'), DB::raw("DATE_FORMAT(created_at,'%M %Y') as months"))
            ->groupBy('months')->paginate($this->page_element);

        return view('livewire.dashboard.dashboard-component', [
            'dashboard_links' => $this->dashboardLinks(),
            'orders_by_months' => $orders_by_months,
            'product_orders_by_months' => $product_orders_by_months,
            'daily_expenses' => $daily_expenses,
            'daily_expenses_product' => $daily_expenses_product,
        ]);

    }
}
