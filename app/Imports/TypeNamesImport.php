<?php

namespace App\Imports;

use App\Models\TypeName;
use Maatwebsite\Excel\Concerns\ToModel;

class TypeNamesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new TypeName([
            //
        ]);
    }
}
