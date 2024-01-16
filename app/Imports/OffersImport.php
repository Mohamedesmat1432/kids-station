<?php

namespace App\Imports;

use App\Models\Offer;
use Maatwebsite\Excel\Concerns\ToModel;

class OffersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Offer([
            //
        ]);
    }
}
