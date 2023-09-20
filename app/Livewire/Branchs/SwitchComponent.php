<?php

namespace App\Livewire\Branchs;

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
                $query->where('port', 'like', '%' . $this->search . '%');
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
        $this->port = $switch->port;
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

}
