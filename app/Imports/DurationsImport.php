<?php

namespace App\Imports;

use App\Models\Duration;
use Maatwebsite\Excel\Concerns\ToModel;

class DurationsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Duration([
            //
        ]);
    }
}
