<?php

namespace App\Imports;

use App\Models\SwitchBranch;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SwitchImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new SwitchBranch([
            'hostname' => $row['hostname'],
            'ip' => $row['ip'],
            'platform' => $row['platform'],
            'version' => $row['version'],
            'floor' => $row['floor'],
            'location' => $row['location'],
            'password' => $row['password'],
            'password_enable' => $row['password_enable'],
        ]);
    }

    public function rules(): array
    {
        return [
            'hostname' => ['required', 'string', 'unique:switch_branchs,hostname'],
            'ip' => ['required', 'string', 'unique:switch_branchs,ip'],
            'platform' => ['nullable', 'string'],
            'version' => ['nullable', 'string'],
            'floor' => ['nullable', 'string'],
            'location' => ['nullable', 'string'],
            'password' => ['nullable', 'string'],
            'password_enable' => ['nullable', 'string'],
        ];
    }
}
