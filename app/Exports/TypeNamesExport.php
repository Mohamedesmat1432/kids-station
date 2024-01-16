<?php

namespace App\Exports;

use App\Models\TypeName;
use Maatwebsite\Excel\Concerns\FromCollection;

class TypeNamesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TypeName::all();
    }
}
