<?php

namespace App\Livewire\Category;

use App\Exports\CategorysExport;
use App\Imports\CategorysImport;
use App\Traits\CategoryTrait;
use App\Traits\WithNotify;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImportExportCategory extends Component
{
    use CategoryTrait;

    public function importModal()
    {
        $this->reset();
        $this->resetValidation();
        $this->import_modal = true;
    }

    public function import(CategorysImport $import)
    {
        $this->validate(['file' => 'required|file|mimes:xlsx,xls,csv']);
        try {
            $this->import_modal = false;
            $this->dispatch('import-category');
            $this->successNotify(__('site.categories_imported'));
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
            $this->dispatch('export-category');
            $this->successNotify(__('site.categories_exported'));
            return (new CategorysExport($this->search))->download('categories.' . $this->extension);
        } catch (\Throwable $e) {
            $this->errorNotify($e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.category.import-export-category');
    }
}
