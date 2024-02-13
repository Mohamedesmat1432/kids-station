<?php

namespace App\Livewire\Product;

use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use App\Traits\ProductTrait;
use App\Traits\WithNotify;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImportExportProduct extends Component
{
    use ProductTrait;

    public function importModal()
    {
        $this->reset();
        $this->resetValidation();
        $this->import_modal = true;
    }

    public function import(ProductsImport $import)
    {
        $this->validate(['file' => 'required|file|mimes:xlsx,xls,csv']);
        try {
            $this->import_modal = false;
            $this->dispatch('import-product');
            $this->successNotify(__('site.products_imported'));
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
            $this->dispatch('export-product');
            $this->successNotify(__('site.products_exported'));
            return (new ProductsExport($this->search))->download('products.' . $this->extension);
        } catch (\Throwable $e) {
            $this->errorNotify($e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.product.import-export-product');
    }
}
