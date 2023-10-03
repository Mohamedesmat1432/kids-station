<?php

namespace App\Livewire\Forms;

use App\Models\Company;
use Livewire\Form;

class CompanyForm extends Form
{
    public ?Company $company;
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

    protected $validationAttributes = [
        'name' => 'Name',
        'email' => 'Email',
        'address' => 'Address',
        'contacts' => 'Contacts',
        'specialization' => 'Specialization',
    ];

    public function setCompany(Company $company)
    {
        $this->company = $company;
        $this->company_id = $company->id;
        $this->name = $company->name;
        $this->email = $company->email;
        $this->address = $company->address;
        $this->contacts = $company->contacts;
        $this->specialization = $company->specialization;
    }

    public function store()
    {
        $validated = $this->validate();
        Company::create($validated);
        $this->reset();
    }

    public function update()
    {
        $validated = $this->validate();
        $this->company->update($validated);
    }

    public function delete()
    {
        $company = Company::findOrFail($this->company_id);
        $company->licenses()->update(['company_id' => null]);
        $company->delete();
    }
}
