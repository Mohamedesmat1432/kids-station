<?php

namespace App\Livewire\Branchs;

use App\Models\PatchBranch;
use App\Traits\PatchTrait;
use Livewire\Component;

class PatchComponent extends Component
{
    use PatchTrait;

    public function render()
    {
        $this->authorize('view-patch');
        
        $this->bulk_disabled = count($this->selected_patch);

        $patchs = PatchBranch::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('port', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')->paginate(10);

        return view('livewire.branchs.patch-component', [
            'patchs' => $patchs
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
        $patch = PatchBranch::findOrFail($id);
        $this->patch_id = $patch->id;
        $this->port = $patch->port;
    }

    public function save()
    {
        $validated = $this->validate();
        if (isset($this->patch_id)) {
            $patch = PatchBranch::findOrFail($this->patch_id);
            $patch->update($validated);
            $this->successMessage(__('Patch updated successfully'));
        } else {
            PatchBranch::create($validated);
            $this->successMessage(__('Patch created successfully'));
        }

        $this->confirm_form = false;
    }

    public function confirmDeletion($id)
    {
        $this->confirm_delete = $id;
    }

    public function delete()
    {
        $patch = PatchBranch::findOrFail($this->confirm_delete);
        $patch->edokis()->update(['patch_id' => null]);
        $patch->emadEdeens()->update(['patch_id' => null]);
        $patch->delete();
        $this->successMessage(__('Patch deleted successfully'));
        $this->confirm_delete = false;
    }

    public function confirmDeletionAll()
    {
        $this->confirm_delete = true;
    }

    public function selectedAll()
    {
        if (count($this->selected_patch) > 0) {
            $this->selected_patch = [];
        } else {
            $this->selected_patch = PatchBranch::pluck('id');
        }
    }

    public function deleteAll()
    {
        $patchs = PatchBranch::whereIn('id', $this->selected_patch);
        foreach ($patchs as $patch) {
            $patch->edokis()->update(['patch_id' => null]);
            $patch->emadEdeens()->update(['patch_id' => null]);
        }
        $patchs->delete();
        $this->successMessage(__('Selected patch deleted successfully'));
        $this->confirm_delete = false;
        $this->selected_patch = [];
        $this->bulk_disabled = false;
    }
}
