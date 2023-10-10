<?php

namespace App\Exports;

use App\Models\License;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LicensesExport implements FromCollection, WithHeadings, WithStyles
{
    use Exportable;

    public $search;

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
        return License::select('id', 'name','status', 'start_date', 'end_date')
            ->where('name', 'like', '%' . $this->search . '%')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Status',
            'Start Date',
            'End Date'
        ];
    }
}
