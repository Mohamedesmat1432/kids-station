<?php

namespace App\Exports;

use App\Models\MoneySafe;
use Maatwebsite\Excel\Concerns\FromCollection;

class MoneySafesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return MoneySafe::all();
    }
}
