<?php

namespace App\Imports;

use App\Models\Visitor;
use Maatwebsite\Excel\Concerns\ToModel;

class VisitorsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Visitor([
            //
        ]);
    }
}
