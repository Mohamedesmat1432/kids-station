<?php

namespace App\Imports;

use App\Models\MoneySafeProduct;
use Maatwebsite\Excel\Concerns\ToModel;

class MoneySafeProductsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new MoneySafeProduct([
            //
        ]);
    }
}
