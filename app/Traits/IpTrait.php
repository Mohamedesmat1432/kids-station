<?php

namespace App\Traits;

use Livewire\WithPagination;

trait IpTrait
{
    use WithPagination, ConfirmTrait, SortSearchTrait, MessageTrait;

    public $ip_id;
    public $number;

    protected function rules()
    {
        return [
            'number' => 'required|string|min:2|unique:ips,number,' . $this->ip_id,
        ];
    }

    public function resetItems()
    {
        $this->reset();
        $this->resetValidation();
    }
}
