<?php

namespace App\Http\Controllers\Helper;

use Carbon\Carbon;
use App\Models\Codes;
use App\Models\License;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Dev_3zozzController extends Controller
{

    public static function getDayNameFromDate($date)
    {
        // Parse the date using Carbon
        $carbonDate = Carbon::parse($date);

        // Set locale to Arabic
        Carbon::setLocale('ar');

        // Return the day name in Arabic
        return $carbonDate->translatedFormat('l');
    }

}
