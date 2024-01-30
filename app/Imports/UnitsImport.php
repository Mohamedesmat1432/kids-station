<?php

namespace App\Imports;

use App\Models\Unit;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UnitsImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Unit([
            'name' => $row['name'],
            'qty' => $row['qty'],
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string','unique:units,name'],
            'qty' => ['required', 'numeric'],
        ];
    }
}
