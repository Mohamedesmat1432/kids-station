<?php

namespace App\Livewire\Dashboard;

use App\Models\Category;
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
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class DashboardComponent extends Component
{
    public function dashboardLinks()
    {
        return[
            [
                'name' => 'users',
                'value' => __('site.users'),
                'icon' => 'user-group',
                'role' => 'view-user',
                'bg' => 'bg-blue-500',
                'hover' => 'bg-blue-600',
                'count' => User::count()
            ],
            [
                'name' => 'roles',
                'value' =>  __('site.roles'),
                'icon' => 'lock-closed',
                'role' => 'view-role',
                'bg' => 'bg-gray-400',
                'hover' => 'bg-gray-500',
                'count' => Role::count()
            ],
            [
                'name' => 'permissions',
                'value' =>  __('site.permissions'),
                'icon' => 'receipt-percent',
                'role' => 'view-permission',
                'bg' => 'bg-gray-500',
                'hover' => 'bg-gray-600',
                'count' => Permission::count()
            ],
            [
                'name' => 'orders',
                'value' =>  __('site.orders'),
                'icon' => 'briefcase',
                'role' => 'view-order',
                'bg' => 'bg-green-500',
                'hover' => 'bg-green-600',
                'count' => Order::count(),
                'total' => Order::sum('total') - Order::sum('last_total'),
            ],
            [
                'name' => 'product.orders',
                'value' => __('site.product_orders'),
                'icon' => 'briefcase',
                'role' => 'view-product-order',
                'bg' => 'bg-gray-500',
                'hover' => 'bg-gray-600',
                'count' => ProductOrder::count()
            ],
            [
                'name' => 'categories',
                'value' => __('site.categories'),
                'icon' => 'rectangle-group',
                'role' => 'view-category',
                'bg' => 'bg-red-500',
                'hover' => 'bg-red-600',
                'count' => Category::count()
            ],
            [
                'name' => 'units',
                'value' =>  __('site.units'),
                'icon' => 'currency-dollar',
                'role' => 'view-unit',
                'bg' => 'bg-gray-500',
                'hover' => 'bg-gray-600',
                'count' => Unit::count()
            ],
            [
                'name' => 'products',
                'value' =>  __('site.products'),
                'icon' => 'clipboard-document-check',
                'role' => 'view-product',
                'bg' => 'bg-green-500',
                'hover' => 'bg-green-600',
                'count' => Product::count()
            ],
            [
                'name' => 'type.names',
                'value' => __('site.type_names'),
                'icon' => 'clipboard-document-list',
                'role' => 'view-type-name',
                'bg' => 'bg-red-500',
                'hover' => 'bg-red-600',
                'count' => TypeName::count()
            ],
            [
                'name' => 'types',
                'value' => __('site.types'),
                'icon' => 'adjustments-horizontal',
                'role' => 'view-type',
                'bg' => 'bg-green-500',
                'hover' => 'bg-green-600',
                'count' => Type::count()
            ],
            [
                'name' => 'offers',
                'value' => __('site.offers'),
                'icon' => 'gift',
                'role' => 'view-offer',
                'bg' => 'bg-yellow-500',
                'hover' => 'bg-yellow-600',
                'count' => Offer::count(),
            ],
        ];
    }

    public static function totalOrdersByMonth(){
        $orders = Order::select(
            DB::raw('sum(total) as total'),
            DB::raw('sum(last_total) as last_total'),
            DB::raw("DATE_FORMAT(created_at,'%M %Y') as months")
        )
            // ->where("created_at", ">", \Carbon\Carbon::now()->subMonths(6))
            ->groupBy('months')
            ->get();

        return $orders;
    }
    
    public function render()
    {
        return view('livewire.dashboard.dashboard-component', [
            'dashboard_links' => $this->dashboardLinks(),
        ]);
    }
}
