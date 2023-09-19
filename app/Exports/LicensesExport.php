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

    public function styles(Worksheet $sheet)
    {

        return [
            // Style the first row as bold text.
            1    => [
                'font' => ['bold' => true, 'italic' => true],
                'color' => ['#FFFF00' => true],
                'width' => ['200px' => true],
            ],

            // Styling a specific cell by coordinate.
            'B' => [
                'font' => ['italic' => true],
            ],

            // Styling an entire column.
            // 'C'  => ['font' => ['size' => 16]],
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return License::select('id', 'name', 'start_date', 'end_date')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Name', 'Start Date', 'End Date'];
    }
}
