<?php


namespace App\Helpers;


class DateTime
{
    public static function handlerDateTime($datetime)
    {
        $array = explode('T', $datetime);
        return $array[0] . ' ' . $array[1];
    }
}