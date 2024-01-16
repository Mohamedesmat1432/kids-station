<?php

namespace App\Livewire\Dashboard;

use App\Models\Category;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Type;
use App\Models\TypeName;
use App\Models\Unit;
use App\Models\User;
use Livewire\Component;

class DashboardComponent extends Component
{
    
    public function render()
    {
        return view('livewire.dashboard.dashboard-component', [
            'users' => User::count(),
            'roles' => Role::count(),
            'permissions' => Permission::count(),
            'categories' => Category::count(),
            'units' => Unit::count(),
            'type_names' => TypeName::count(),
            'types' => Type::count(),
            'offers' => Offer::count(),
            'orders' => Order::count(),
        ]);
    }
}
