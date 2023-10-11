<?php

namespace App\Livewire\Forms;

use App\Models\Orange;
use Livewire\Form;

class OrangeForm extends Form
{
    public ?Orange $orange;
    public $orange_id;
    public $company_id;
    public $name;
    public $price;
    public $seats;
    public $status;
    public $start_date;
    public $end_date;
    public $checkbox_arr = [];

    protected function rules()
    {
        $rules =  [
            'name' => 'required|string|min:3|unique:oranges,name,' . $this->orange_id,
            'price' => 'required|numeric',
            'seats' => 'required|numeric',
            'status' => 'required|in:active,pendding,cancelled',
            'company_id' => 'nullable|numeric|exists:companies,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ];

        return $rules;
    }

    protected $validationAttributes = [
        'name' => 'Name',
        'company_id' => 'Company Id',
        'price' => 'Price',
        'seats' => 'seats',
        'status' => 'Status',
        'start_date' => 'Start Date',
        'end_date' => 'End Date',
    ];

    public function store()
    {
        $validated = $this->validate();
        Orange::create($validated);
        $this->reset();
    }

    public function setOrange(Orange $orange)
    {
        $this->orange = $orange;
        $this->orange_id = $orange->id;
        $this->name = $orange->name;
        $this->price = $orange->price;
        $this->seats = $orange->seats;
        $this->status = $orange->status;
        $this->company_id = $orange->company_id;
        $this->start_date = $orange->start_date;
        $this->end_date = $orange->end_date;
    }

    public function update()
    {
        $validated = $this->validate();
        $this->orange->update($validated);
    }

    public function delete($id)
    {
        $orange = Orange::findOrFail($id);
        $orange->delete();
    }

    public function checkboxAll()
    {
        $data = Orange::pluck('id')->toArray();
        $checkbox_count = count($this->checkbox_arr);

        if ($checkbox_count <= 1 || $checkbox_count < count($data)) {
            $this->checkbox_arr = $data;
        } else {
            $this->checkbox_arr = [];
        }
    }

    public function bulkDelete()
    {
        $oranges = Orange::whereIn('id', $this->checkbox_arr);
        $oranges->delete();
    }
}
