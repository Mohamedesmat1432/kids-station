<?php

namespace App\Livewire\Dashboard;

use App\Models\Company;
use App\Models\Department;
use App\Models\Device;
use App\Models\Edoki;
use App\Models\EmadEdeen;
use App\Models\Ip;
use App\Models\License;
use App\Models\Orange;
use App\Models\PatchBranch;
use App\Models\Permission;
use App\Models\Point;
use App\Models\Role;
use App\Models\SwitchBranch;
use App\Models\User;
use Livewire\Component;

class DashboardComponent extends Component
{
    public function render()
    {
        $users = User::count();
        $roles = Role::count();
        $permissions = Permission::count();
        $departments = Department::count();
        $companies = Company::count();
        $licenses = License::count();
        $oranges = Orange::count();
        $patchs = PatchBranch::count();
        $points = Point::count();
        $devices = Device::count();
        $switchs = SwitchBranch::count();
        $ips = Ip::count();
        $edokis = Edoki::count();
        $emadEdeens = EmadEdeen::count();

        return view('livewire.dashboard.dashboard-component', [
            'users' => $users,
            'roles' => $roles,
            'permissions' => $permissions,
            'departments' => $departments,
            'companies' => $companies,
            'licenses' => $licenses,
            'oranges' => $oranges,
            'patchs' => $patchs,
            'devices' => $devices,
            'points' => $points,
            'switchs' => $switchs,
            'ips' => $ips,
            'edokis' => $edokis,
            'emadEdeens' => $emadEdeens,
        ]);
    }
}
