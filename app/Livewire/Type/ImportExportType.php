<?php

namespace App\Livewire\Type;

use App\Exports\TypesExport;
use App\Imports\TypesImport;
use App\Traits\WithNotify;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImportExportType extends Component
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

    public function import(TypesImport $import)
    {
        $this->validate(['file' => 'required|file|mimes:xlsx,xls,csv']);
        try {
            $this->import_modal = false;
            $this->dispatch('import-type-name');
            $this->successNotify(__('site.type_names_imported'));
            return $import->import($this->file);
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
            $this->dispatch('export-type-name');
            $this->successNotify(__('site.type_names_exported'));
            return (new TypesExport($this->search))->download('type_names.' . $this->extension);
        } catch (\Throwable $e) {
            $this->errorNotify($e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.type.import-export-type');
    }
}
