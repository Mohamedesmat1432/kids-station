<?php

namespace App\Exports;

use App\Models\TypeVisitor;
use Maatwebsite\Excel\Concerns\FromCollection;

class TypeVisitorsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TypeVisitor::all();
    }
}
