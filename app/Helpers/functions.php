<?php

//FUNÇÕES MANIPULAÇÃO DE DATAS
if (!function_exists('convertStringToDate')) {

    function convertStringToDate($param)
    {
        return is_string($param) ? new \DateTime($param) : $param;
    }
}

if (!function_exists('isWeekend')) {

    function isWeekend($param)
    {
        $date = convertStringToDate($param);
        return $date->format('N') >= 6;
    }
}

if (!function_exists('isBefore')) {

    function isBefore($param1, $param2)
    {
        $date1 = convertStringToDate($param1);
        $date2 = convertStringToDate($param2);
        return $date1 <= $date2;
    }
}

if (!function_exists('isPastWorkDay')) {

    function isPastWorkDay($param)
    {
        return !isWeekend($param) && isBefore($param, new \DateTime());
    }
}

if (!function_exists('nextDay')) {

    function nextDay($param)
    {
        $date = convertStringToDate($param);
        $date->modify("+1 day");
        return $date->format('d/m/Y');
    }
}

if (!function_exists('sumDateFromInterval')) {

    function sumDateFromInterval($param1, $param2)
    {
        $date = new DateTime('00:00:00');

        $date->add($param1);
        $date->add($param2);

        return (new \DateTime('00:00:00'))->diff($date);
    }
}

if (!function_exists('subDateFromInterval')) {

    function subDateFromInterval($param1, $param2)
    {
        $date = new DateTime('00:00:00');

        $date->add($param1);
        $date->sub($param2);

        return (new \DateTime('00:00:00'))->diff($date);
    }
}

if (!function_exists('convertSecondsToDateInterval')) {

    function convertSecondsToDateInterval($param)
    {
        $date = new DateTimeImmutable();
        $date_1 = $date->add($param);
        return $date_1->getTimestamp() - $date->getTimestamp();
    }
}

if (!function_exists('convertIntervalToDate')) {

    function convertIntervalToDate($param)
    {
        return (new \DateTime($param->format('%H:%I:%S')));
    }
}

if (!function_exists('convertStringToDate')) {

    function convertStringToDate($param)
    {
        return DateTime::createFromFormat('H:i:s', $param);
    }
}

if (!function_exists('firstDayOfMonth')) {

    function firstDayOfMonth($param)
    {
        $date = convertStringToDate($param)->getTimestamp();
        return (new DateTime(date('Y-m-1', $date)));
    }
}

if (!function_exists('lastDayOfMonth')) {

    function lastDayOfMonth($param)
    {
        $date = convertStringToDate($param)->getTimestamp();
        return (new DateTime(date('Y-m-t', $date)));
    }
}

if (!function_exists('convertTimeToHour')) {

    function convertTimeToHour($param)
    {
        $h = intdiv($param, 3600);
        $m = intdiv($param % 3600, 60);
        $s = $param - ($h * 3600) - ($m * 60);
        return sprintf("%02d:%02d:%02d", $h, $m, $s);
    }
}




