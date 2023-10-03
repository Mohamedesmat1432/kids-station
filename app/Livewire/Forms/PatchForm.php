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

    public function delete()
    {
        $patch = PatchBranch::findOrFail($this->patch_id);
        $patch->edokis()->update(['patch_id' => null]);
        $patch->emadEdeens()->update(['patch_id' => null]);
        $patch->delete();
    }
}
