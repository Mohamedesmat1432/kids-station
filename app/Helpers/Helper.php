<?php

namespace App\Helpers;

use Carbon\Carbon;

class Helper
{

    public static function countDays($start, $end)
    {
        return Carbon::parse($start)->diffInDays(Carbon::parse($end), false);
    }

    public static function formatHours($date)
    {
        return Carbon::parse($date)->timezone("Africa/Cairo")->format("h:i a");
    }

    public static function formatDate($date)
    {
        return Carbon::parse($date)->timezone("Africa/Cairo")->format("Y-m-d");
    }

    public static function formatFullDate($date)
    {
        return Carbon::parse($date)->timezone("Africa/Cairo")->format("Y-m-d h:i a");
    }
}
