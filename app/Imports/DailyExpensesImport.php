<?php

namespace App\Imports;

use App\Models\DailyExpense;
use Maatwebsite\Excel\Concerns\ToModel;

class DailyExpensesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DailyExpense([
            //
        ]);
    }
}
