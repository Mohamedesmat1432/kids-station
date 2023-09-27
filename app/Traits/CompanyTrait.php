<?php

namespace App\Traits;

use Livewire\WithPagination;

trait CompanyTrait
{
    use WithPagination, FileTrait, ConfirmTrait, SortSearchTrait, MessageTrait;

    public $company_id;
    public $name;
    public $email;
    public $address;
    public $contacts;
    public $specialization;

    protected function rules()
    {
        return [
            'name' => 'required|string|min:4',
            'email' => 'nullable|string|email',
            'address' => 'nullable|string',
            'contacts' => 'nullable|string',
            'specialization' => 'nullable|string|max:500',
        ];
    }

    public function resetItems()
    {
        $this->reset();
        $this->resetValidation();
    }
}
