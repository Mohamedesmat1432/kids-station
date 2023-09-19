<?php

namespace App\Livewire\Schema;

use App\Models\Department;
use App\Models\Device;
use App\Models\Edoki;
use App\Models\Ip;
use App\Models\PatchBranch;
use App\Models\SwitchBranch;
use App\Traits\EdokiTrait;
use Livewire\Component;

class EdokiComponent extends Component
{
    use EdokiTrait;

    protected $queryString = [
        'search' => ['except' => ''],
        'sort_by' => ['except' => 'id'],
        'sort_asc' => ['except' => true]
    ];

    public function render()
    {
        $departments = Department::select('id', 'name')->get();
        $devices = Device::select('id', 'name')->get();
        $ips = Ip::select('id', 'number')->get();
        $patchs = PatchBranch::select('id', 'port')->get();
        $switchs = SwitchBranch::select('id', 'port')->get();

        $edokis = Edoki::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')->paginate(10);

        return view('livewire.schema.edoki-component', [
            'edokis' => $edokis,
            'departments' => $departments,
            'devices' => $devices,
            'ips' => $ips,
            'patchs' => $patchs,
            'switchs' => $switchs,
        ]);
    }

    public function confirmEdokiAdd()
    {
        $this->resetItems();
        $this->confirm_form = true;
    }


    public function confirmEdokiEdit($id)
    {
        $this->resetItems();
        $this->confirm_form = true;
        $edoki = Edoki::findOrFail($id);
        $this->edoki_id = $edoki->id;
        $this->name = $edoki->name;
        $this->email = $edoki->email;
        $this->department_id = $edoki->department_id;
        $this->device_id = $edoki->device_id;
        $this->ip_id = $edoki->ip_id;
        $this->switch_id = $edoki->switch_id;
        $this->patch_id = $edoki->patch_id;
    }

    public function saveEdoki()
    {
        $validated = $this->validate();
        if (isset($this->edoki_id)) {
            $edoki = Edoki::findOrFail($this->edoki_id);
            $edoki->update($validated);
            $this->successMessage(__('Edoki updated successfully'));
        } else {
            Edoki::create($validated);
            $this->successMessage(__('Edoki created successfully'));
        }

        $this->confirm_form = false;
    }

    public function confirmEdokiDeletion($id)
    {
        $this->confirm_delete = $id;
    }

    public function deleteEdoki()
    {
        $edoki = Edoki::findOrFail($this->confirm_delete);
        $edoki->delete();
        $this->successMessage(__('Edoki deleted successfully'));
        $this->confirm_delete = false;
    }
}
