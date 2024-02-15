<?php

namespace App\Livewire\TypeName;

use App\Exports\TypeNamesExport;
use App\Imports\TypeNamesImport;
use App\Traits\TypeNameTrait;
use Livewire\Component;

class ImportExportTypeName extends Component
{
    use TypeNameTrait;

    public function importModal()
    {
        $this->reset();
        $this->resetValidation();
        $this->import_modal = true;
    }

    public function import(TypeNamesImport $import)
    {
        $this->validate(['file' => 'required|file|mimes:xlsx,xls,csv']);
        try {
            $this->import_modal = false;
            $this->dispatch('refresh-list-type-name');
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
            $this->dispatch('refresh-list-type-name');
            $this->successNotify(__('site.type_names_exported'));
            return (new TypeNamesExport($this->search))->download('type_names.' . $this->extension);
        } catch (\Throwable $e) {
            $this->errorNotify($e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.type-name.import-export-type-name');
    }
}
