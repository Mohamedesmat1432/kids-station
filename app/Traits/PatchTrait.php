<?php

namespace App\Traits;

use Livewire\WithPagination;

trait PatchTrait
{
    use WithPagination, ConfirmTrait, SortSearchTrait, MessageTrait;

    public $patch_id, $port;

    protected function rules()
    {
        return [
            'port' => 'required|string|min:2|unique:patch_branchs,port,' . $this->patch_id,
        ];
    }

    public function resetItems()
    {
        $this->reset();
        $this->resetValidation();
    }
}
