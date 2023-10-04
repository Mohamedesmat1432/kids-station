<?php

namespace App\Livewire\Ip;

use App\Models\Ip;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class BulkDeleteIp extends Component
{
    use WithNotify;

    public $bulk_delete_modal = false;
    public $arr = [], $count;

    #[On('bulk-delete-modal')]
    public function confirmDelete($arr)
    {
        $this->arr = explode(',', $arr);
        $this->count = count($this->arr);
        $this->bulk_delete_modal = true;
    }

    public function delete()
    {
        $ips = Ip::whereIn('id', $this->arr);

        foreach ($ips as $ip) {
            $ip->edokis()->update(['ip_id' => null]);
            $ip->emadEdeens()->update(['ip_id' => null]);
        }
        
        $ips->delete();
        $this->dispatch('bulk-delete-ip');
        $this->dispatch('bulk-delete-clear');
        $this->successNotify(__('ips deleted successfully'));
        $this->bulk_delete_modal = false;
    }

    public function render()
    {
        return view('livewire.ip.bulk-delete-ip');
    }
}
