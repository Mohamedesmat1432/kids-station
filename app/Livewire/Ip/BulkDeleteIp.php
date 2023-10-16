<?php

namespace App\Livewire\Ip;

use App\Livewire\Forms\IpForm;
use App\Models\Ip;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class BulkDeleteIp extends Component
{
    use WithNotify;

    public IpForm $form;
    public $bulk_delete_modal = false;
    public $count;

    #[On('bulk-delete-modal')]
    public function confirmDelete($arr)
    {
        $this->form->checkbox_arr = json_decode($arr);
        $this->count = count($this->form->checkbox_arr);
        $this->bulk_delete_modal = true;
    }

    public function delete()
    {
        $this->form->bulkDelete();
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
