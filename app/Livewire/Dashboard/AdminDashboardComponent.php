<?php

namespace App\Livewire\Dashboard;

use App\Models\Company;
use App\Models\Department;
use App\Models\Edoki;
use App\Models\EmadEdeen;
use App\Models\Ip;
use App\Models\License;
use App\Models\PatchBranch;
use App\Models\SwitchBranch;
use App\Models\User;
use Livewire\Component;

class AdminDashboardComponent extends Component
{
    public function render()
    {
        $users = User::count();
        $departments = Department::count();
        $companies = Company::count();
        $licenses = License::count();
        $patchs = PatchBranch::count();
        $switchs = SwitchBranch::count();
        $ips = Ip::count();
        $edokis = Edoki::count();
        $emadEdeens = EmadEdeen::count();

        return view('livewire.dashboard.admin-dashboard-component', [
            'users' => $users,
            'departments' => $departments,
            'companies' => $companies,
            'licenses' => $licenses,
            'patchs' => $patchs,
            'switchs' => $switchs,
            'ips' => $ips,
            'edokis' => $edokis,
            'emadEdeens' => $emadEdeens,
        ]);
    }
}
