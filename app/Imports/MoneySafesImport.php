<?php

namespace App\Imports;

use App\Models\MoneySafe;
use Maatwebsite\Excel\Concerns\ToModel;

class MoneySafesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new MoneySafe([
            //
        ]);
    }
}
