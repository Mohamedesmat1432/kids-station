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

        $this->bulk_disabled = count($this->selected_switch);

        $switchs = SwitchBranch::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('hostname', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')->paginate(10);

        return view('livewire.branchs.switch-component', [
            'switchs' => $switchs
        ]);
    }

    public function confirmAdd()
    {
        $this->resetItems();
        $this->confirm_form = true;
    }

    public function confirmEdit($id)
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

    public function save()
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

    public function confirmDeletion($id)
    {
        $this->confirm_delete = $id;
    }

    public function delete()
    {
        $switch = SwitchBranch::findOrFail($this->confirm_delete);
        $switch->edokis()->update(['switch_id' => null]);
        $switch->emadEdeens()->update(['switch_id' => null]);
        $switch->delete();
        $this->successMessage(__('Switch deleted successfully'));
        $this->confirm_delete = false;
    }

    public function confirmDeletionAll()
    {
        $this->confirm_delete = true;
    }

    public function selectedAll()
    {
        if (count($this->selected_switch) > 0) {
            $this->selected_switch = [];
        } else {
            $this->selected_switch = SwitchBranch::pluck('id');
        }
    }

    public function deleteAll()
    {
        $switchs = SwitchBranch::whereIn('id', $this->selected_switch);
        foreach ($switchs as $switch) {
            $switch->edokis()->update(['switch_id' => null]);
            $switch->emadEdeens()->update(['switch_id' => null]);
        }
        $switchs->delete();
        $this->successMessage(__('Selected switch deleted successfully'));
        $this->confirm_delete = false;
        $this->selected_switch = [];
        $this->bulk_disabled = false;
    }

    public function confirmImport()
    {
        $this->confirm_import = true;
    }

    public function import(SwitchImport $importSwitch)
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

    public function export()
    {
        try {
            $this->successMessage(__('Switch exported successfully'));
            return new SwitchExport($this->search);
        } catch (\Throwable $e) {
            $this->errorMessage($e->getMessage());
        }
    }
}
