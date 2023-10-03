<?php

namespace App\Livewire\Company;

use App\Models\Company;
use App\Traits\SortSearchTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListCompany extends Component
{
    use WithPagination, SortSearchTrait;

    public $checkbox_arr = [];

    public function checkboxAll()
    {
        if (empty($this->checkbox_arr)) {
            $this->checkbox_arr = Company::pluck('id')->toArray();
        } else {
            $this->checkbox_arr = [];
        }
    }

    #[On('bulk-delete-clear')]
    public function checkboxClear()
    {
        $this->checkbox_arr = [];
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
        })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')->latest()->paginate(10);

        return view('livewire.company.list-company', [
            'companies' => $companies
        ]);
    }
}
