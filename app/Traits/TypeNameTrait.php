<?php

namespace App\Traits;

use App\Models\TypeName;

trait TypeNameTrait
{
    use WithNotify;
    public ?TypeName $type_name;
    public $type_name_id;
    public $name;
    public $status;
    public $checkbox_arr = [];

    protected function rules()
    {
        return [
            'name' => 'required|string',
            'status' => 'required|boolean',
        ];
    }

    public function setTypeName($id)
    {
        $this->type_name = TypeName::findOrFail($id);
        $this->type_name_id = $this->type_name->id;
        $this->name = $this->type_name->name;
        $this->status =  $this->type_name->status;
    }

    public function storeTypeName()
    {
        $validated = $this->validate();
        TypeName::create($validated);
        $this->reset();
    }

    public function updateTypeName()
    {
        $validated = $this->validate();
        $this->type_name->update($validated);
    }

    public function deleteTypeName($id)
    {
        $type_name = TypeName::findOrFail($id);
        $type_name->delete();
    }

    public function checkboxAll()
    {
        $data = TypeName::pluck('id')->toArray();
        $checkbox_count = count($this->checkbox_arr);

        if ($checkbox_count < 1 || $checkbox_count < count($data)) {
            $this->checkbox_arr = $data;
        } else {
            $this->checkbox_arr = [];
        }
    }

    public function bulkDeleteTypeName()
    {
        $type_names = TypeName::whereIn('id', $this->checkbox_arr);
        $type_names->delete();
    }
}
