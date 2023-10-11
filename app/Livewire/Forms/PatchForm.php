<?php

namespace App\Livewire\Forms;

use App\Models\PatchBranch;
use Livewire\Form;

class PatchForm extends Form
{
    public ?PatchBranch $patch;
    public $patch_id;
    public $port;
    public $selected_patch = [];
    public $bulk_disabled = false;
    public $checkbox_arr = [];

    protected function rules()
    {
        return [
            'port' => 'required|string|min:2|unique:patch_branchs,port,' . $this->patch_id,
        ];
    }

    protected $validationAttributes = [
        'port' => 'Port',
    ];

    public function setPatch(PatchBranch $patch)
    {
        $this->patch = $patch;
        $this->patch_id = $patch->id;
        $this->port = $patch->port;
    }

    public function store()
    {
        $validated = $this->validate();
        PatchBranch::create($validated);
        $this->reset();
    }

    public function update()
    {
        $validated = $this->validate();
        $this->patch->update($validated);
    }

    public function delete($id)
    {
        $patch = PatchBranch::findOrFail($id);
        $patch->edokis()->update(['patch_id' => null]);
        $patch->emadEdeens()->update(['patch_id' => null]);
        $patch->delete();
    }

    public function checkboxAll()
    {
        $data = PatchBranch::pluck('id')->toArray();
        $checkbox_count = count($this->checkbox_arr);

        if ($checkbox_count <= 1 || $checkbox_count < count($data)) {
            $this->checkbox_arr = $data;
        } else {
            $this->checkbox_arr = [];
        }
    }

    public function bulkDelete()
    {
        $patchs = PatchBranch::whereIn('id', $this->checkbox_arr);

        foreach ($patchs as $patch) {
            $patch->edokis()->update(['patch_id' => null]);
            $patch->emadEdeens()->update(['patch_id' => null]);
        }

        $patchs->delete();
    }
}
