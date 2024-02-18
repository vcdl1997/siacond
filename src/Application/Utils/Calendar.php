<?php

final class Calendar
{
    const YEAR = 0;
    const MONTH = 1;
    const DAY = 2;

    public static function getDifferenceInYears(string $date) :int
    {
        $date = new DateTime($date);
        $today = new DateTime();
        $interval = $today->diff($date);

        return intval($interval->format('%y'));
    }

    public static function dateExists(string $date) :bool
    {
        $split_date = explode("-", $date);
        
        return checkdate($split_date[self::MONTH], $split_date[self::DAY], $split_date[self::YEAR]);
    }
}