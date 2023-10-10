<?php

namespace App\Exports;

use App\Models\Point;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PointExport implements FromCollection, WithHeadings
{
    use Exportable;

    public $search;

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
