<?php

namespace App\Livewire\Forms;

use App\Helpers\Helper;
use App\Models\License;
use App\Traits\FileTrait;
use Livewire\Form;

class LicenseForm extends Form
{
    use FileTrait;

    public ?License $license;
    public $license_id;
    public $company_id;
    public $name;
    public $status;
    public $start_date;
    public $end_date;
    public $checkbox_arr = [];

    protected function rules()
    {
        $rules =  [
            'name' => 'required|string|min:3|unique:licenses,name,' . $this->license_id,
            'status' => 'required|in:success,warning,danger,expired',
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

    protected $validationAttributes = [
        'name' => 'Name',
        'company_id' => 'Company Id',
        'status' => 'Status',
        'file' => 'File',
        'files' => 'Files',
        'start_date' => 'Start Date',
        'end_date' => 'End Date',
    ];

    public function checkStatus()
    {
        if (Helper::countDays(now(), $this->end_date) >= 1 && Helper::countDays(now(), $this->end_date) < 180) {
            $this->status = 'danger';
        } elseif (Helper::countDays(now(), $this->end_date) >= 180 && Helper::countDays(now(), $this->end_date) < 300) {
            $this->status = 'warning';
        } elseif (Helper::countDays(now(), $this->end_date) >= 300) {
            $this->status = 'success';
        } else {
            $this->status = 'expired';
        }
        return $this->status;  
    }

    public function store()
    {
        $this->status = $this->checkStatus();
        $validated = $this->validate();
        $validated['file'] = $this->uploadFile($this->file, 'licenses');
        $validated['files'] = $this->uploadFiles($this->files, 'licenses');
        License::create($validated);
        $this->reset();
    }

    public function setLicense(License $license)
    {
        $this->license = $license;
        $this->license_id = $license->id;
        $this->name = $license->name;
        $this->status = $license->status;
        $this->company_id = $license->company_id;
        $this->file = $license->file;
        $this->files = $license->files;
        $this->start_date = $license->start_date;
        $this->end_date = $license->end_date;
    }

    public function update()
    {
        $validated = $this->validate();
        $validated['status'] = $this->checkStatus();
        if (isset($this->newFile)) {
            $this->deleteFile($this->license->file, 'licenses');
            $validated['file'] = $this->uploadFile($this->newFile, 'licenses');
        }

        if (isset($this->newFiles)) {
            $this->deleteFiles($this->license->files, 'licenses');
            $validated['files'] = $this->uploadFiles($this->newFiles, 'licenses');
        }

        $this->license->update($validated);
    }

    public function delete()
    {
        $license = License::findOrFail($this->license_id);
        $this->deleteFile($license->file, 'licenses');
        $this->deleteFiles($license->files, 'licenses');
        $license->delete();
    }

    public function checkboxAll()
    {
        $data = License::pluck('id')->toArray();
        $checkbox_count = count($this->checkbox_arr);

        if ($checkbox_count <= 1 || $checkbox_count < count($data)) {
            $this->checkbox_arr = $data;
        } else {
            $this->checkbox_arr = [];
        }
    }

    public function bulkDelete()
    {
        $licenses = License::whereIn('id', $this->checkbox_arr);

        foreach ($licenses as $license) {
            $this->deleteFile($license->file, 'licenses');
            $this->deleteFiles($license->files, 'licenses');
        }

        $licenses->delete();
    }
}
