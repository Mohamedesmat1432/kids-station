<?php

namespace App\Exports;

use App\Models\MoneySafeProduct;
use Maatwebsite\Excel\Concerns\FromCollection;

class MoneySafeProductsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return MoneySafeProduct::all();
    }
}
