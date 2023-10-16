<?php

namespace App\Exports;

use App\Models\Point;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PointExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
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
        return Point::select('id', 'name')
            ->where('name', 'like', '%' . $this->search . '%')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
        ];
    }
}
