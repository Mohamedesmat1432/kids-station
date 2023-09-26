<?php

namespace App\Exports;

use App\Models\Edoki;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Excel;
use Illuminate\Contracts\Support\Responsable;

class EdokiExport implements FromCollection, WithHeadings, Responsable
{
    use Exportable;

    public $search;

    private $fileName = 'edoki_schema.xlsx';

    private $writerType = Excel::XLSX;

    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    public function __construct($search)
    {
        $this->search = $search;
    }

    public function collection()
    {
        return Edoki::select('id', 'name', 'email', 'department_id', 'device_id', 'ip_id', 'switch_id', 'patch_id', 'point_id', 'port')
            ->where('name', 'like', '%' . $this->search . '%')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Department',
            'Device',
            'Ip',
            'Switch',
            'Patch',
            'Point',
            'Switch Port',
        ];
    }
}
