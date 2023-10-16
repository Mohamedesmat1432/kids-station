<?php

namespace App\Livewire\License;

use App\Exports\LicensesExport;
use App\Imports\LicensesImport;
use App\Traits\WithNotify;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImportExportLicense extends Component
{
    use WithNotify, WithFileUploads;

    public $file;
    public $import_modal = false;
    public $export_modal = false;
    public $extension = 'xlsx';
    public $search = '';

    public function importModal()
    {
        $this->reset();
        $this->resetValidation();
       $this->import_modal = true;
    }

    public function import(LicensesImport $importLicense)
    {
        $this->validate(['file' => 'required|mimes:xlsx,xls']);
        try {
            $this->import_modal = false;
            $this->dispatch('import-license');
            $this->successNotify(__('License imported successfully'));
            return $importLicense->import($this->file);
        } catch (\Throwable $e) {
            $this->errorNotify($e->getMessage());
        }
    }

    public function exportModal()
    {
        $this->reset();
        $this->resetValidation();
        $this->export_modal = true;
    }

    public function export()
    {
        try {
            $this->export_modal = false;
            $this->dispatch('export-license');
            $this->successNotify(__('License exported successfully'));
            return (new LicensesExport($this->search))->download('licenses.' . $this->extension);
        } catch (\Throwable $e) {
            $this->errorNotify($e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.license.import-export-license');
    }
}
