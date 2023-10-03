<?php

namespace App\Livewire\License;

use App\Exports\LicensesExport;
use App\Imports\LicensesImport;
use App\Traits\FileTrait;
use App\Traits\SortSearchTrait;
use App\Traits\WithNotify;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImportExportLicense extends Component
{
    use WithNotify, SortSearchTrait, WithFileUploads;

    public $file;
    public $import_modal = false;

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

    public function export()
    {
        try {
            $this->successNotify(__('License exported successfully'));
            return (new LicensesExport($this->search));
        } catch (\Throwable $e) {
            $this->errorNotify($e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.license.import-export-license');
    }
}
