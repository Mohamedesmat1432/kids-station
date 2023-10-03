<?php

namespace App\Livewire\Company;

use App\Exports\CompaniesExport;
use App\Imports\CompaniesImport;
use App\Traits\SortSearchTrait;
use App\Traits\WithNotify;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImportExportCompany extends Component
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

    public function import(CompaniesImport $importCompany)
    {
        $this->validate(['file' => 'required|mimes:xlsx,xls']);
        try {
            $this->import_modal = false;
            $this->dispatch('import-company');
            $this->successNotify(__('Companies imported successfully'));
            return $importCompany->import($this->file);
        } catch (\Throwable $e) {
            $this->errorNotify($e->getMessage());
        }
    }

    public function export()
    {
        try {
            $this->successNotify(__('Companies exported successfully'));
            return (new CompaniesExport($this->search));
        } catch (\Throwable $e) {
            $this->errorNotify($e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.company.import-export-company');
    }
}
