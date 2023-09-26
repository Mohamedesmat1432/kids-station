<?php

namespace App\Imports;

use App\Models\EmadEdeen;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class EmadEdeenImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new EmadEdeen([
            'name' => $row['name'],
            'email' => $row['email'],
            'department_id' => $row['department_id'],
            'device_id' => $row['device_id'],
            'ip_id' => $row['ip_id'],
            'switch_id' => $row['switch_id'],
            'point_id' => $row['point_id'],
            'patch_id' => $row['patch_id'],
            'port' => $row['port'],
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:edokis,email'],
            'department_id' => ['nullable', 'numeric'],
            'device_id' => ['nullable', 'numeric'],
            'ip_id' => ['nullable', 'numeric'],
            'switch_id' => ['nullable', 'numeric'],
            'point_id' => ['nullable', 'numeric'],
            'patch_id' => ['nullable', 'numeric'],
            'port' => ['nullable', 'numeric'],
        ];
    }
}

