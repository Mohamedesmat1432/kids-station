<?php

namespace App\Imports;

use App\Models\Company;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class CompaniesImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Company([
            'name' => $row['name'],
            'address' => $row['address'],
            'email' => $row['email'],
            'contacts' => $row['contacts'],
            'specialization' => $row['specialization'],
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'address' => ['nullable', 'string'],
            'email' => ['nullable', 'string'],
            'contacts' => ['nullable', 'string'],
            'specialization' => ['nullable', 'string'],
        ];
    }
}
