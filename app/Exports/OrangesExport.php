<?php

namespace App\Exports;

use App\Models\Orange;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class OrangesExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
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
        return Orange::select('id', 'name', 'price', 'number', 'status', 'start_date', 'end_date')
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('status', 'like', '%' . $this->search . '%')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Price',
            'Number',
            'Status',
            'Start Date',
            'End Date'
        ];
    }
}
