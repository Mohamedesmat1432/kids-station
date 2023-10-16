<?php

namespace App\Livewire\Edoki;

use App\Exports\EdokiExport;
use App\Imports\EdokiImport;
use App\Traits\WithNotify;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImportExportSchema extends Component
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

    public function import(EdokiImport $importSchema)
    {
        $this->validate(['file' => 'required|mimes:xlsx,xls']);
        try {
            $this->import_modal = false;
            $this->dispatch('import-schema');
            $this->successNotify(__('Schema imported successfully'));
            return $importSchema->import($this->file);
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
            $this->dispatch('export-schema');
            $this->successNotify(__('Schema exported successfully'));
            return (new EdokiExport($this->search))->download('edoki-schema.' . $this->extension);
        } catch (\Throwable $e) {
            $this->errorNotify($e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.edoki.import-export-schema');
    }
}
