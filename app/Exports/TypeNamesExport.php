<?php

namespace App\Exports;

use App\Models\TypeName;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TypeNamesExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
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
        $sheet->getStyle('A1:Z' . TypeName::count() + 1)->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1:Z1')->getFont()->setBold(true);
        return;
    }

    public function collection()
    {
        return TypeName::select('id', 'name', 'status')
            ->where('name', 'like', '%' . $this->search . '%')
            ->get();
    }

    public function headings(): array
    {
        return ['ID', 'Name', 'Status'];
    }
}
