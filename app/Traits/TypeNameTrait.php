<?php

namespace App\Traits;

use App\Models\TypeName;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

trait TypeNameTrait
{
    use WithNotify, SortSearchTrait, WithPagination, ModalTrait, WithFileUploads;

    public ?TypeName $type_name;
    public $type_name_id;
    public $name;
    public $status;
    public $checkbox_arr = [];
    public $file;
    public $extension = 'xlsx';

    protected function rules()
    {
        return [
            'name' => 'required|string',
            'status' => 'required|boolean',
        ];
    }

    public function typeNameList()
    {
        $type_names = $this->trash ? TypeName::onlyTrashed() : TypeName::withoutTrashed();
            
        return $type_names->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
            ->search($this->search)->paginate($this->page_element);
    }

    public function setTypeName($id)
    {
        $this->type_name = TypeName::findOrFail($id);
        $this->type_name_id = $this->type_name->id;
        $this->name = $this->type_name->name;
        $this->status = $this->type_name->status;
    }

    public function storeTypeName()
    {
        $validated = $this->validate();
        TypeName::create($validated);
        $this->reset();
    }

    public function updateTypeName()
    {
        $validated = $this->validate();
        $this->type_name->update($validated);
    }

    public function deleteTypeName($id)
    {
        $type_name = TypeName::findOrFail($id);
        $type_name->delete();
    }

    public function checkboxAll()
    {
        $types_trashed = TypeName::onlyTrashed()->pluck('id')->toArray();
        $types = TypeName::pluck('id')->toArray();
        $checkbox_count = count($this->checkbox_arr);
        $data = $this->trash ? $types_trashed : $types;

        if ($checkbox_count < count($data)) {
            $this->checkbox_arr = $data;
        } else {
            $this->checkbox_arr = [];
        }
    }

    public function bulkDeleteTypeName()
    {
        $type_names = TypeName::whereIn('id', $this->checkbox_arr);
        $type_names->delete();
    }

    public function restoreTypeName($id)
    {
        $type_name = TypeName::onlyTrashed()->findOrFail($id);
        $type_name->restore();
    }

    public function forceDeleteTypeName($id)
    {
        $type_name = TypeName::onlyTrashed()->findOrFail($id);
        $type_name->forceDelete();
    }

    public function forceBulkDeleteTypeName()
    {
        $type_names = TypeName::onlyTrashed()->whereIn('id', $this->checkbox_arr);
        $type_names->forceDelete();
    }
}
