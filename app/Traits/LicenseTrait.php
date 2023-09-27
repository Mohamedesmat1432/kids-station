<?php

namespace App\Traits;

use Livewire\WithPagination;

trait LicenseTrait
{
    use WithPagination, FileTrait, ConfirmTrait, SortSearchTrait, MessageTrait;

    public $license_id;
    public $company;
    public $company_id;
    public $name;
    public $start_date;
    public $end_date;
    public $license_show;

    protected function rules()
    {
        $rules =  [
            'name' => 'required|string|min:3|unique:licenses,name,' . $this->license_id,
            'company_id' => 'nullable|numeric|exists:companies,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ];

        if (isset($this->license_id)) {
            $rules['newFile'] = $this->fileRule;
            $rules['newFiles.*'] = $this->fileRule;
        } else {
            $rules['file'] = $this->fileRule;
            $rules['files.*'] = $this->fileRule;
        }
        return $rules;
    }

    public function resetItems()
    {
        $this->reset();
        $this->resetValidation();
    }
}
