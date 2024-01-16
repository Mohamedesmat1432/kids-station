<?php

namespace App\Exports;

use App\Models\Duration;
use Maatwebsite\Excel\Concerns\FromCollection;

class DurationsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Duration::all();
    }
}
