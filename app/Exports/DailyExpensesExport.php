<?php

namespace App\Exports;

use App\Models\DailyExpense;
use Maatwebsite\Excel\Concerns\FromCollection;

class DailyExpensesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DailyExpense::all();
    }
}
