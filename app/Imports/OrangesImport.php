<?php

namespace App\Imports;

use App\Models\Orange;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class OrangesImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Orange([
            'name'     => $row['name'],
            'price'    => $row['price'],
            'number'    => $row['number'],
            'status'    => $row['status'],
            'start_date' => $row['start_date'],
            'end_date' => $row['end_date'],
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'unique:licenses,name'],
            'price' => ['required', 'numeric'],
            'number' => ['required', 'numeric'],
            'status' => ['required', 'string'],
            'start_date' => ['required'],
            'end_date' => ['required'],
        ];
    }
}