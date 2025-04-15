<?php

namespace App\Helpers;

class NumberConverter{
public  function __construct()
{
    
}
public static function englishToPersianNumber($number)
{
    $persianDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];

    $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

    $persianNumber = str_replace($englishDigits, $persianDigits, $number);

    return $persianNumber;
}
public static function persianToEnglishNumber($number){

    $persianDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];

    $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    $englishNumber = str_replace($persianDigits, $englishDigits, $number);

    return $englishNumber;
}
}