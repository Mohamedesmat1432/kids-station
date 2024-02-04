<?php

namespace App\Imports;

use App\Models\TypeName;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class TypeNamesImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new TypeName([
            'name' => $row['name'],
            'status' => $row['status'],
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'unique:type_names,name'],
            'status' => ['required', 'boolean'],
        ];
    }
}
