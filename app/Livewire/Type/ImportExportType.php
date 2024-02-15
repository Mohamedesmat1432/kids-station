<?php

namespace App\Livewire\Type;

use App\Exports\TypesExport;
use App\Imports\TypesImport;
use App\Traits\TypeTrait;
use Livewire\Component;

class ImportExportType extends Component
{
    use TypeTrait;

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
            $this->dispatch('refresh-list-type');
            $this->successNotify(__('site.types_imported'));
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
            $this->dispatch('refresh-list-type');
            $this->successNotify(__('site.types_exported'));
            return (new TypesExport($this->search))->download('types.' . $this->extension);
        } catch (\Throwable $e) {
            $this->errorNotify($e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.type.import-export-type');
    }
}
