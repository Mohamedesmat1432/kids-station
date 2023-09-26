<?php

namespace App\Livewire\Schema;

use App\Exports\EmadEdeenExport;
use App\Imports\EmadEdeenImport;
use App\Models\Department;
use App\Models\Device;
use App\Models\EmadEdeen;
use App\Models\Ip;
use App\Models\PatchBranch;
use App\Models\Point;
use App\Models\SwitchBranch;
use App\Traits\EmadEdeenTrait;
use Livewire\Component;

class EmadEdeenComponent extends Component
{
    use EmadEdeenTrait;

    public function render()
    {
        $this->authorize('view-schema');
        
        $departments = Department::pluck('name', 'id');
        $devices = Device::pluck('name', 'id');
        $ips = Ip::pluck('number', 'id');
        $patchs = PatchBranch::pluck('port', 'id');
        $emadEdeenNullSwitch = EmadEdeen::where('switch_id', '!=', null)->pluck('switch_id');
        $switchs = SwitchBranch::pluck('hostname', 'id');
        $points = Point::pluck('name', 'id');

        $emadEdeens = EmadEdeen::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')->paginate(10);

        return view('livewire.schema.emad-edeen-component', [
            'emadEdeens' => $emadEdeens,
            'departments' => $departments,
            'devices' => $devices,
            'ips' => $ips,
            'patchs' => $patchs,
            'switchs' => $switchs,
            'points' => $points,
        ]);
    }

    public function confirmEmadEdeenAdd()
    {
        $this->resetItems();
        $this->confirm_form = true;
    }

    public function confirmEmadEdeenEdit($id)
    {
        $this->resetItems();
        $this->confirm_form = true;
        $emadEdeen = EmadEdeen::findOrFail($id);
        $this->emadedeen_id = $emadEdeen->id;
        $this->name = $emadEdeen->name;
        $this->email = $emadEdeen->email;
        $this->department_id = $emadEdeen->department_id;
        $this->device_id = $emadEdeen->device_id;
        $this->ip_id = $emadEdeen->ip_id;
        $this->switch_id = $emadEdeen->switch_id;
        $this->patch_id = $emadEdeen->patch_id;
        $this->point_id = $emadEdeen->point_id;
        $this->port = $emadEdeen->port;
    }

    public function saveEmadEdeen()
    {
        $validated = $this->validate();
        if (isset($this->emadedeen_id)) {
            $emadEdeen = EmadEdeen::findOrFail($this->emadedeen_id);
            $emadEdeen->update($validated);
            $this->successMessage(__('Emad Edeen updated successfully'));
        } else {
            EmadEdeen::create($validated);
            $this->successMessage(__('Emad Edeen created successfully'));
        }

        $this->confirm_form = false;
    }

    public function confirmEmadEdeenDeletion($id)
    {
        $this->confirm_delete = true;
        $this->emadedeen_id = $id;
    }

    public function deleteEmadEdeen()
    {
        $emadEdeen = EmadEdeen::findOrFail($this->emadedeen_id);
        $emadEdeen->delete();
        $this->successMessage(__('Emad Edeen deleted successfully'));
        $this->confirm_delete = false;
    }

    public function confirmImport()
    {
        $this->confirm_import = true;
    }

    public function importEmadEdeen(EmadEdeenImport $importSchema)
    {
        $this->validate(['file' => 'required|mimes:xlsx,xls']);
        try {
            $this->successMessage(__('EmadEdeen schema imported successfully'));
            $this->confirm_import = false;
            return $importSchema->import($this->file);
        } catch (\Throwable $e) {
            $this->errorMessage($e->getMessage());
        }
    }

    public function exportEmadEdeen()
    {
        try {
            $this->successMessage(__('EmadEdeen schema exported successfully'));
            return new EmadEdeenExport($this->search);
        } catch (\Throwable $e) {
            $this->errorMessage($e->getMessage());
        }
    }
}
