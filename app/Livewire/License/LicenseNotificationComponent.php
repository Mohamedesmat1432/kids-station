<?php

namespace App\Livewire\License;

use App\Models\License;
use Carbon\Carbon;
use Livewire\Component;

class LicenseNotificationComponent extends Component
{
    public $count;
    public $licensesMonth = [];
    public $notifications;

    public function render()
    {
        $this->notifications = $this->notification();

        return view('livewire.license.license-notification-component');
    }

    public function notification()
    {
        $licenses = License::all();
        foreach ($licenses as  $license) {
            $months = Carbon::parse($license->end_date)->diffInMonths(Carbon::parse($license->start_date));
            if (in_array($license->name, $this->licensesMonth) || $months < 3 || $months > 8) {
                array_splice($this->licensesMonth, $license->id);
            } elseif(!in_array($license->name, $this->licensesMonth) && $months >= 3 && $months <= 8) {
                array_push($this->licensesMonth, $license->name);
            }
        }
        $this->count = count($this->licensesMonth);
        return [
            'licensesMonth' => $this->licensesMonth
        ];
    }
}
