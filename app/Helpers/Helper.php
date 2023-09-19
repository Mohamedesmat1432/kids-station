<?php

namespace App\Helpers;

use Carbon\Carbon;

class Helper
{

    public static function countDays($start, $end)
    {
        return Carbon::parse($start)->diffInDays(Carbon::parse($end), false);
    }
}
