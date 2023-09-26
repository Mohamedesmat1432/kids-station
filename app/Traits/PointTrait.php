<?php

namespace App\Traits;

use Livewire\WithPagination;

trait PointTrait {

    use WithPagination, ConfirmTrait, SortSearchTrait, MessageTrait, FileTrait;

    public $point_id, $name;

    protected function rules()
    {
        return [
            'name' => 'required|string|min:2|unique:points,name,' . $this->point_id
        ];
    }

    public function resetItems()
    {
        $this->reset();
        $this->resetValidation();
    }
}