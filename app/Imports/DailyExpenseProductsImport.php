<?php

namespace App\Imports;

use App\Models\DailyExpenseProduct;
use Maatwebsite\Excel\Concerns\ToModel;

class DailyExpenseProductsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DailyExpenseProduct([
            //
        ]);
    }
}
