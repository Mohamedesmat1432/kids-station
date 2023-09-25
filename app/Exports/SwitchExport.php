<?php

namespace App\Exports;

use App\Models\SwitchBranch;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Excel;
use Illuminate\Contracts\Support\Responsable;

class SwitchExport implements FromCollection, WithHeadings, Responsable
{
    use Exportable;

    public $search;

    private $fileName = 'switchs.xlsx';

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
