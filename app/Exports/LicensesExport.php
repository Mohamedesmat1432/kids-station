<?php

namespace App\Exports;

use App\Models\License;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LicensesExport implements FromCollection, WithHeadings, Responsable, WithStyles
{
    use Exportable;

    public $search;

    private $fileName = 'licenses.xlsx';

    private $writerType = Excel::XLSX;

    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    public function styles(Worksheet $sheet)
    {
        return [
            1    => [
                'font' => ['bold' => true, 'italic' => true],
                'color' => ['#FFFF00' => true],
                'width' => ['200px' => true],
            ],
        ];
    }
 
    public function __construct($search)
    {
        $this->search = $search;
    }

    public function collection()
    {
        return License::select('id', 'name', 'start_date', 'end_date')
            ->where('name', 'like', '%' . $this->search . '%')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Start Date',
            'End Date'
        ];
    }
}
