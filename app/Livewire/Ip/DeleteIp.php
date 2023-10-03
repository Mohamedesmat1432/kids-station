<?php

namespace App\Livewire\Ip;

use App\Livewire\Forms\IpForm;
use App\Models\Ip;
use App\Traits\WithNotify;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteIp extends Component
{
    use WithNotify;

    public IpForm $form;

    public $delete_modal = false;

    #[On('delete-modal')]
    public function confirmDelete(Ip $id)
    {
        $this->form->setIp($id);
        $this->delete_modal = true;
    }

    public function delete()
    {
        $this->form->delete();
        $this->dispatch('delete-ip');
        $this->successNotify(__('Ip deleted successfully'));
        $this->delete_modal = false;
    }

    public function render()
    {
        return view('livewire.ip.delete-ip');
    }
}
