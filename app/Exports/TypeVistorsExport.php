<?php

namespace App\Exports;

use App\Models\TypeVistor;
use Maatwebsite\Excel\Concerns\FromCollection;

class TypeVistorsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TypeVistor::all();
    }
}
