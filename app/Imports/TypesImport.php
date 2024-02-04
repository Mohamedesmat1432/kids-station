<?php

namespace App\Imports;

use App\Models\Type;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class TypesImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Type([
            'type_name_id' => $row['type_name_id'],
            'price' => $row['price'],
            'duration' => $row['duration'],
            'status' => $row['status'],
        ]);
    }

    public function rules(): array
    {
        return [
            'type_name_id' => ['required', 'numeric', 'exists:type_names,id'],
            'price' => ['required', 'numeric'],
            'duration' => ['required', 'duration'],
            'status' => ['required', 'boolean'],
        ];
    }
}
