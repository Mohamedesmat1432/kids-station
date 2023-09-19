<?php

namespace App\Traits;

use Livewire\WithPagination;

trait SwitchTrait
{
    use WithPagination, ConfirmTrait, SortSearchTrait, MessageTrait;

    public $switch_id, $port;

    protected function rules()
    {
        return [
            'port' => 'required|string|min:2|unique:switch_branchs,port,' . $this->switch_id,
        ];
    }

    public function resetItems()
    {
        $this->reset();
        $this->resetValidation();
    }
}
