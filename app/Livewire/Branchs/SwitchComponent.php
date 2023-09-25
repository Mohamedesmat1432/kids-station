<?php

namespace App\Livewire\Branchs;

use App\Exports\SwitchExport;
use App\Imports\SwitchImport;
use App\Models\SwitchBranch;
use App\Traits\SwitchTrait;
use Livewire\Component;

class SwitchComponent extends Component
{
    use SwitchTrait;

    public function render()
    {
        $this->authorize('view-switch');

        $switchs = SwitchBranch::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('hostname', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')->paginate(10);

        return view('livewire.branchs.switch-component', [
            'switchs' => $switchs
        ]);
    }

    public function confirmSwitchAdd()
    {
        $this->resetItems();
        $this->confirm_form = true;
    }

    public function confirmSwitchEdit($id)
    {
        $this->resetItems();
        $this->confirm_form = true;
        $switch = SwitchBranch::findOrFail($id);
        $this->switch_id = $switch->id;
        $this->hostname = $switch->hostname;
        $this->ip = $switch->ip;
        $this->platform = $switch->platform;
        $this->version = $switch->version;
        $this->floor = $switch->floor;
        $this->location = $switch->location;
        $this->password = $switch->password;
        $this->password_enable = $switch->password_enable;
    }

    public function saveSwitch()
    {
        $validated = $this->validate();
        if (isset($this->switch_id)) {
            $switch = SwitchBranch::findOrFail($this->switch_id);
            $switch->update($validated);
            $this->successMessage(__('Switch updated successfully'));
        } else {
            SwitchBranch::create($validated);
            $this->successMessage(__('Switch created successfully'));
        }

        $this->confirm_form = false;
    }

    public function confirmSwitchDeletion($id)
    {
        $this->confirm_delete = $id;
    }

    public function deleteSwitch()
    {
        $switch = SwitchBranch::findOrFail($this->confirm_delete);
        $switch->edokis()->update(['switch_id' => null]);
        $switch->emadEdeens()->update(['switch_id' => null]);
        $switch->delete();
        $this->successMessage(__('Switch deleted successfully'));
        $this->confirm_delete = false;
    }

    public function confirmImport()
    {
        $this->confirm_import = true;
    }

    public function importSwitch(SwitchImport $importSwitch)
    {
        $this->validate(['file' => 'required|mimes:xlsx,xls']);
        try {
            $this->successMessage(__('Switchs imported successfully'));
            $this->confirm_import = false;
            return $importSwitch->import($this->file);
        } catch (\Throwable $e) {
            $this->errorMessage($e->getMessage());
        }
    }

    public function exportSwitch()
    {
        try {
            $this->successMessage(__('Switch exported successfully'));
            return new SwitchExport($this->search);
        } catch (\Throwable $e) {
            $this->errorMessage($e->getMessage());
        }
    }

}
