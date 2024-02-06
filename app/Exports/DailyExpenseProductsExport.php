<?php

namespace App\Exports;

use App\Models\DailyExpenseProduct;
use Maatwebsite\Excel\Concerns\FromCollection;

class DailyExpenseProductsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DailyExpenseProduct::all();
    }
}
