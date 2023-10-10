<?php

namespace App\Exports;

use App\Models\Company;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CompaniesExport implements FromCollection, WithHeadings
{
    use Exportable;

    public $search;

    public function __construct($search)
    {
        $this->search = $search;
    }

    public function collection()
    {
        return Company::select('id', 'name', 'email', 'address', 'contacts', 'specialization')
            ->where('name', 'like', '%' . $this->search . '%')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Address',
            'Contacts',
            'Specialization'
        ];
    }
}
