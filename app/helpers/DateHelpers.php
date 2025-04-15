<?php

namespace App\Helpers;

use Morilog\Jalali\Jalalian;

use Illuminate\Support\Carbon;
use Carbon\Exceptions\Exception;
use Exception as InvalidDateException;  // Add this line

class DateHelpers
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
   
    public static  function persianToEnglishDate($string)
    {

        $persianDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        $date = str_replace($persianDigits, $englishDigits, $string);

        $jalaliDate = Jalalian::fromFormat("Y/m/d", $date);

        $gorgianDate = $jalaliDate->toCarbon();

        return $gorgianDate;
    }
    //convert gergian date to persian
    public static function gregorianToPersianDate($date)
    {
         // Convert the input date string to a Carbon instance
    $carbonDate = Carbon::parse($date);
        $jalaliDate = Jalalian::fromCarbon($carbonDate)->format('Y/m/d');

        return NumberConverter::englishToPersianNumber($jalaliDate);
    }

    
}
