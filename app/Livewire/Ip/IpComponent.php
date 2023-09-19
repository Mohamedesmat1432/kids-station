<?php

namespace App\Livewire\Ip;

use App\Models\Ip;
use App\Traits\IpTrait;
use Livewire\Component;

class IpComponent extends Component
{
    use IpTrait;

    protected $queryString = [
        'search' => ['except' => ''],
        'sort_by' => ['except' => 'id'],
        'sort_asc' => ['except' => true]
    ];

    public function render()
    {
        $ips = Ip::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('number', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')->paginate(10);

        return view('livewire.ip.ip-component', [
            'ips' => $ips
        ]);
    }

    public function confirmIpAdd()
    {
        $this->resetItems();
        $this->confirm_form = true;
    }

    public function confirmIpEdit($id)
    {
        $this->resetItems();
        $this->confirm_form = true;
        $ip = Ip::findOrFail($id);
        $this->ip_id = $ip->id;
        $this->number = $ip->number;
    }

    public function saveIp()
    {
        $validated = $this->validate();
        if (isset($this->ip_id)) {
            $ip = Ip::findOrFail($this->ip_id);
            $ip->update($validated);
            $this->successMessage(__('Ip updated successfully'));
        } else {
            Ip::create($validated);
            $this->successMessage(__('Ip created successfully'));
        }

        $this->confirm_form = false;
    }

    public function confirmIpDeletion($id)
    {
        $this->confirm_delete = $id;
    }

    public function deleteIp()
    {
        $ip = Ip::findOrFail($this->confirm_delete);
        $ip->edokis()->update(['ip_id' => null]);
        $ip->emadEdeens()->update(['ip_id' => null]);
        $ip->delete();
        $this->successMessage(__('Ip deleted successfully'));
        $this->confirm_delete = false;
    }
}
