<?php

namespace App\Livewire\Orange;

use App\Exports\OrangesExport;
use App\Imports\OrangesImport;
use App\Traits\WithNotify;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImportExportOrange extends Component
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

    public function import(OrangesImport $importOrange)
    {
        $this->validate(['file' => 'required|mimes:xlsx,xls']);
        try {
            $this->import_modal = false;
            $this->dispatch('import-orange');
            $this->successNotify(__('Orange imported successfully'));
            return $importOrange->import($this->file);
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
            $this->dispatch('export-orange');
            $this->successNotify(__('Orange exported successfully'));
            return (new OrangesExport($this->search))->download('oranges.' . $this->extension);
        } catch (\Throwable $e) {
            $this->errorNotify($e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.orange.import-export-orange');
    }
}
