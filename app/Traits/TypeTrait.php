<?php

namespace App\Traits;

use App\Models\Type;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

trait TypeTrait
{
    use WithNotify, SortSearchTrait, WithPagination, ModalTrait, WithFileUploads;

    public ?Type $type;
    public $type_id;
    public $type_name_id;
    public $price;
    public $duration;
    public $status;
    public $checkbox_arr = [];
    public $file;
    public $extension = 'xlsx';

    protected function rules()
    {
        return [
            'type_name_id' => 'required|numeric|exists:type_names,id',
            'price' => 'required|numeric',
            'duration' => 'required|numeric',
            'status' => 'required|boolean|in:0,1',
        ];
    }

    public function setType($id)
    {
        $this->type = Type::findOrFail($id);
        $this->type_id = $this->type->id;
        $this->type_name_id = $this->type->type_name_id;
        $this->price = $this->type->price;
        $this->duration = $this->type->duration;
        $this->status = $this->type->status;
    }

    public function storeType()
    {
        $validated = $this->validate();
        Type::create($validated);
        $this->reset();
    }

    public function updateType()
    {
        $validated = $this->validate();
        $this->type->update($validated);
    }

    public function deleteType($id)
    {
        $type = Type::findOrFail($id);
        $type->delete();
    }

    public function checkboxAll()
    {
        $types_trashed = Type::onlyTrashed()->pluck('id')->toArray();
        $types = Type::pluck('id')->toArray();
        $checkbox_count = count($this->checkbox_arr);
        $data = $this->trash ? $types_trashed : $types;

        if ($checkbox_count < count($data)) {
            $this->checkbox_arr = $data;
        } else {
            $this->checkbox_arr = [];
        }
    }

    public function bulkDeleteType()
    {
        $types = Type::whereIn('id', $this->checkbox_arr);
        $types->delete();
    }

    public function typeList()
    {
        $types = $this->trash ? Type::onlyTrashed() : Type::withoutTrashed();
            
        return $types->when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('price', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
            ->paginate($this->page_element);
    }

    public function restoreType($id)
    {
        $type = Type::onlyTrashed()->findOrFail($id);
        $type->restore();
    }

    public function forceDeleteType($id)
    {
        $type = Type::onlyTrashed()->findOrFail($id);
        $type->forceDelete();
    }

    public function forceBulkDeleteType()
    {
        $types = Type::onlyTrashed()->whereIn('id', $this->checkbox_arr);
        $types->forceDelete();
    }
}
