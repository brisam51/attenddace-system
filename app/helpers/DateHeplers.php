<?php

namespace App\helpers;

use Carbon\Exceptions\Exception;

use Morilog\Jalali\Jalalian;
use Exception as InvalidDateException;  // Add this line
class DateHeplers
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
//=============================

        //========================
        $persianDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        $date = str_replace($persianDigits, $englishDigits, $string);

        $jalaliDate = Jalalian::fromFormat("Y/m/d", $date);

        $gorgianDate = $jalaliDate->toCarbon();

        return $gorgianDate;
    }

    //convert English number to persian
    public static function englishToPersianNumber($number)
    {
        $persianDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];

        $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        $persianNumber = str_replace($englishDigits, $persianDigits, $number);

        return $persianNumber;
    }
}

