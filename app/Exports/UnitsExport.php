<?php

namespace App\Exports;

use App\Models\Unit;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UnitsExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */

    protected $search = '';

    public function __construct($search)
    {
        $this->search = $search;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => [
                'font' => ['bold' => true],
                'color' => ['#FFFF00' => true],
            ],
        ];
    }

    public function collection()
    {
        return Unit::select('id', 'name','qty')
            ->where('name', 'like', '%' . $this->search . '%')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'QTY',
        ];
    }
}
