<?php

namespace App\Livewire\Unit;

use App\Exports\UnitsExport;
use App\Imports\UnitsImport;
use App\Traits\UnitTrait;
use Livewire\Component;

class ImportExportUnit extends Component
{
    use UnitTrait;

    public function importModal()
    {
        $this->reset();
        $this->resetValidation();
        $this->import_modal = true;
    }

    public function import(UnitsImport $import)
    {
        $this->validate(['file' => 'required|file|mimes:xlsx,xls,csv']);
        try {
            $this->import_modal = false;
            $this->dispatch('refresh-list-unit');
            $this->successNotify(__('site.units_imported'));
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
            $this->dispatch('refresh-list-unit');
            $this->successNotify(__('site.units_exported'));
            return (new UnitsExport($this->search))->download('units.' . $this->extension);
        } catch (\Throwable $e) {
            $this->errorNotify($e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.unit.import-export-unit');
    }
}
