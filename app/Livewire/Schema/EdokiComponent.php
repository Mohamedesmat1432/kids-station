<?php

namespace App\Livewire\Schema;

use App\Exports\EdokiExport;
use App\Imports\EdokiImport;
use App\Models\Department;
use App\Models\Device;
use App\Models\Edoki;
use App\Models\Ip;
use App\Models\PatchBranch;
use App\Models\Point;
use App\Models\SwitchBranch;
use App\Traits\EdokiTrait;
use Livewire\Component;

class EdokiComponent extends Component
{
    use EdokiTrait;

    public function render()
    {
        $this->authorize('view-schema');

        $departments = Department::pluck('name', 'id');
        $devices = Device::pluck('name', 'id');
        $ips = Ip::pluck('number', 'id');
        $patchs = PatchBranch::pluck('port', 'id');
        $edokiNullSwitch = Edoki::where('switch_id','!=',$this->switch_id)->pluck('switch_id');
        $switchs = SwitchBranch::pluck('hostname', 'id');
        $points = Point::pluck('name', 'id');

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
            'points' => $points
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
        $this->point_id = $edoki->point_id;
        $this->port = $edoki->port;
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

    public function confirmImport()
    {
        $this->confirm_import = true;
    }

    public function importEdoki(EdokiImport $importSchema)
    {
        $this->validate(['file' => 'required|mimes:xlsx,xls']);
        try {
            $this->successMessage(__('Edoki schema imported successfully'));
            $this->confirm_import = false;
            return $importSchema->import($this->file);
        } catch (\Throwable $e) {
            $this->errorMessage($e->getMessage());
        }
    }

    public function exportEdoki()
    {
        try {
            $this->successMessage(__('Edoki schema exported successfully'));
            return new EdokiExport($this->search);
        } catch (\Throwable $e) {
            $this->errorMessage($e->getMessage());
        }
    }
}
