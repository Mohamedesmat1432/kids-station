<?php

namespace App\Livewire\Company;

use App\Exports\CompaniesExport;
use App\Imports\CompaniesImport;
use App\Models\Company;
use App\Traits\CompanyTrait;
use Livewire\Component;

class CompanyComponent extends Component
{
    use CompanyTrait;

    public function render()
    {
        $this->authorize('view-company');

        $companies = Company::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')->latest()->paginate(10);

        return view('livewire.company.company-component', [
            'companies' => $companies
        ]);
    }

    public function confirmCompanyAdd()
    {
        $this->resetItems();
        $this->confirm_form = true;
    }

    public function confirmCompanyEdit($id)
    {
        $this->resetItems();
        $this->confirm_form = true;
        $company = Company::findOrFail($id);
        $this->company_id = $company->id;
        $this->name = $company->name;
        $this->email = $company->email;
        $this->address = $company->address;
        $this->contacts = $company->contacts;
        $this->specialization = $company->specialization;
    }

    public function saveCompany()
    {
        $validated = $this->validate();
        if (isset($this->company_id)) {
            $company = Company::findOrFail($this->company_id);
            $company->update($validated);
            $this->successMessage(__('Company updated successfully'));
        } else {
            Company::create($validated);
            $this->successMessage(__('Company created successfully'));
        }

        $this->confirm_form = false;
    }

    public function confirmCompanyDeletion($id)
    {
        $this->confirm_delete = $id;
    }

    public function deleteCompany()
    {
        $company = Company::findOrFail($this->confirm_delete);
        $company->licenses()->update(['company_id' => null]);
        $company->delete();
        $this->successMessage(__('Company deleted successfully'));
        $this->confirm_delete = false;
    }

    public function confirmImport()
    {
        $this->confirm_import = true;
    }

    public function importCompany(CompaniesImport $importCompany)
    {
        $this->validate(['file' => 'required|mimes:xlsx,xls']);
        try {
            $this->successMessage(__('Companies imported successfully'));
            $this->confirm_import = false;
            return $importCompany->import($this->file);
        } catch (\Throwable $e) {
            $this->errorMessage($e->getMessage());
        }
    }

    public function exportCompany()
    {
        try {
            $this->successMessage(__('Companies imported successfully'));
            return (new CompaniesExport($this->search))->download('companies.xlsx');
        } catch (\Throwable $e) {
            $this->errorMessage($e->getMessage());
        }
    }
}
