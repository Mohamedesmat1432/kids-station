<?php

namespace App\Livewire\Company;

use App\Livewire\Forms\CompanyForm;
use App\Models\Company;
use App\Traits\SortSearchTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListCompany extends Component
{
    use WithPagination, SortSearchTrait;

    public CompanyForm $form;

    public function checkboxAll()
    {
        $this->form->checkboxAll();
    }

    #[On('bulk-delete-clear')]
    public function checkboxClear()
    {
        $this->form->checkbox_arr = [];
    }

    #[On('create-company')]
    #[On('update-company')]
    #[On('delete-company')]
    #[On('import-company')]
    #[On('bulk-delete-company')]
    public function render()
    {
        $this->authorize('view-company');

        $companies = Company::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')->latest()->paginate($this->page_element);

        return view('livewire.company.list-company', [
            'companies' => $companies
        ]);
    }
}
