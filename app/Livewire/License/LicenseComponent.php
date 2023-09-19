<?php

namespace App\Livewire\License;

use App\Models\License;
use Livewire\Component;
use App\Exports\LicensesExport;
use App\Imports\LicensesImport;
use App\Models\Company;
use App\Traits\LicenseTrait;

class LicenseComponent extends Component
{
    use LicenseTrait;

    protected $queryString = [
        'search' => ['except' => ''],
        'sort_by' => ['except' => 'id'],
        'sort_asc' => ['except' => true]
    ];

    public function render()
    {
        $companies = Company::get();

        $licenses = License::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('file', 'like', '%' . $this->search . '%')
                    ->orWhere('start_date', 'like', '%' . $this->search . '%')
                    ->orWhere('end_date', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')->paginate(10);

        return view('livewire.license.license-component', [
            'licenses' => $licenses,
            'companies' => $companies
        ]);
    }

    public function confirmLicenseAdd()
    {
        $this->resetItems();
        $this->confirm_form = true;
    }

    public function confirmLicenseEdit($id)
    {
        $this->resetItems();
        $this->confirm_form = true;
        $license = License::findOrFail($id);
        $this->license_id = $license->id;
        $this->name = $license->name;
        $this->company_id = $license->company_id;
        $this->file = $license->file;
        $this->files = $license->files;
        $this->start_date = $license->start_date;
        $this->end_date = $license->end_date;
    }

    public function confirmLicenseShow($id)
    {
        $this->resetItems();
        $this->confirm_show = true;
        $license = License::findOrFail($id);
    }

    public function saveLicense()
    {
        $validated = $this->validate();
        if (isset($this->license_id)) {
            $license = License::findOrFail($this->license_id);
            if ($this->newFile && $this->newFile !== '') {
                $this->deleteFile($license->file, 'licenses');
                $validated['file'] = $this->uploadFile($this->newFile, 'licenses');
            }
            if ($this->newFiles && $this->newFiles !== '') {
                $this->deleteFiles($license->files, 'licenses');
                $validated['files'] = $this->uploadFiles($this->newFiles, 'licenses');
            }
            $license->update($validated);
            $this->successMessage(__('License updated successfully'));
        } else {
            $validated['file'] = $this->uploadFile($this->file, 'licenses');
            $validated['files'] = $this->uploadFiles($this->files, 'licenses');
            License::create($validated);
            $this->successMessage(__('License created successfully'));
        }
        $this->confirm_form = false;
    }

    public function confirmLicenseDeletion($id)
    {
        $this->confirm_delete = $id;
    }

    public function deleteLicense()
    {
        $license = License::findOrFail($this->confirm_delete);
        $this->deleteFile($license->file, 'licenses');
        $this->deleteFiles($license->files, 'licenses');
        $license->delete();
        $this->successMessage(__('License deleted successfully'));
        $this->confirm_delete = false;
    }

    public function confirmImport()
    {
        $this->confirm_import = true;
    }

    public function importLicense(LicensesImport $importLicenses)
    {
        $this->validate(['file' => 'required|mimes:xlsx,xls']);
        try {
            $this->successMessage(__('License imported successfully'));
            $this->confirm_import = false;
            return $importLicenses->import($this->file);
        } catch (\Throwable $e) {
            $this->errorMessage($e->getMessage());
        }
    }

    public function exportLicense(LicensesExport $exportLicenses)
    {
        try {
            $this->successMessage(__('License exported successfully'));
            return $exportLicenses->download('licenses.xlsx');
        } catch (\Throwable $e) {
            $this->errorMessage($e->getMessage());
        }
    }
}
