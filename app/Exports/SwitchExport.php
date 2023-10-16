<?php

namespace App\Exports;

use App\Models\SwitchBranch;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SwitchExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    use Exportable;

    public $search;

    public function styles(Worksheet $sheet)
    {
        return [
            1    => [
                'font' => ['bold' => true],
                'color' => ['#FFFF00' => true],
            ],
        ];
    }

    public function __construct($search)
    {
        $this->search = $search;
    }

    public function collection()
    {
        return SwitchBranch::select('id', 'hostname', 'ip', 'platform', 'version', 'floor', 'location', 'password', 'password_enable')
            ->where('hostname', 'like', '%' . $this->search . '%')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'HostName',
            'IP',
            'Platform',
            'Version',
            'Floor',
            'Location',
            'Password',
            'Password Enable',
        ];
    }
}
