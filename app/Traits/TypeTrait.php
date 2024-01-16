<?php

namespace App\Traits;

use App\Models\Type;

trait TypeTrait
{
    use WithNotify;
    public ?Type $type;
    public $type_id;
    public $type_name_id;
    public $price;
    public $duration;
    public $status;
    public $checkbox_arr = [];

    protected function rules()
    {
        return [
            'type_name_id' => 'required|numeric|exists:type_names,id',
            'price' => 'required|numeric',
            'duration' => 'required|numeric',
            'status' => 'required|boolean|in:0,1',
        ];
    }

    public function setType($id)
    {
        $this->type = Type::findOrFail($id);
        $this->type_id = $this->type->id;
        $this->type_name_id = $this->type->type_name_id;
        $this->price = $this->type->price;
        $this->duration =  $this->type->duration;
        $this->status =  $this->type->status;
    }

    public function storeType()
    {
        $validated = $this->validate();
        Type::create($validated);
        $this->reset();
    }

    public function updateType()
    {
        $validated = $this->validate();
        $this->type->update($validated);
    }

    public function deleteType($id)
    {
        $type = Type::findOrFail($id);
        $type->delete();
    }

    public function checkboxAll()
    {
        $data = Type::pluck('id')->toArray();
        $checkbox_count = count($this->checkbox_arr);

        if ($checkbox_count < 1 || $checkbox_count < count($data)) {
            $this->checkbox_arr = $data;
        } else {
            $this->checkbox_arr = [];
        }
    }

    public function bulkDeleteType()
    {
        $types = Type::whereIn('id', $this->checkbox_arr);
        $types->delete();
    }
}
