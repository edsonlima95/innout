<?php

//FUNÇÕES MANIPULAÇÃO DE DATAS

/**
 * Recebe uma data e converto para DATETIME
 */
if (!function_exists('convertStringToDate')) {

    function convertStringToDate($param)
    {
        return is_string($param) ? new \DateTime($param) : $param;
    }
}

/**
 * Verifica se a data informada e um fim de semana.
 */
if (!function_exists('isWeekend')) {

    function isWeekend($param)
    {
        $date = convertStringToDate($param);
        return $date->format('N') >= 6;
    }
}

/**
 * Verifica se a data informada e anterior a data atual
 */
if (!function_exists('isBefore')) {

    function isBefore($param1, $param2)
    {
        $date1 = convertStringToDate($param1);
        $date2 = convertStringToDate($param2);
        return $date1 <= $date2;
    }
}

/**
 * Verifica se a data não é um fim de semana e se ela está no passado antes da data atual
 */
if (!function_exists('isPastWorkDay')) {

    function isPastWorkDay($param)
    {
        return !isWeekend($param) && isBefore($param, new \DateTime());
    }
}

/**
 * Retorna um dia a mais da data atual
 */
if (!function_exists('nextDay')) {

    function nextDay($param)
    {
        $date = convertStringToDate($param);
        $date->modify("+1 day");
        return $date->format('d/m/Y');
    }
}

/**
 * Soma um intervalo de tempo a data atual
 */
if (!function_exists('sumDateFromInterval')) {

    function sumDateFromInterval($param1, $param2)
    {
        $date = new DateTime('00:00:00');

        $date->add($param1);
        $date->add($param2);

        return (new \DateTime('00:00:00'))->diff($date);
    }
}

/**
 * Subtrai um intervalo de tempo da data atual
 */
if (!function_exists('subDateFromInterval')) {

    function subDateFromInterval($param1, $param2)
    {
        $date = new DateTime('00:00:00');

        $date->add($param1);
        $date->sub($param2);

        return (new \DateTime('00:00:00'))->diff($date);
    }
}

/**
 * recebe os segundos e converte para um intervalo de tempo
 */
if (!function_exists('convertSecondsToDateInterval')) {

    function convertSecondsToDateInterval($param)
    {
        $date = new DateTimeImmutable();
        $date_1 = $date->add($param);
        return $date_1->getTimestamp() - $date->getTimestamp();
    }
}

/**
 * Converte um intervalo de tempo em uma data.
 */
if (!function_exists('convertIntervalToDate')) {

    function convertIntervalToDate($param)
    {
        return (new \DateTime($param->format('%H:%I:%S')));
    }
}

/**
 * Converte uma string passada como data/tempo em uma data
 */
if (!function_exists('convertStringToDate')) {

    function convertStringToDate($param)
    {
        return DateTime::createFromFormat('H:i:s', $param);
    }
}

/**
 * Retorna o primeiro dia do mês
 */
if (!function_exists('firstDayOfMonth')) {

    function firstDayOfMonth($param)
    {
        $date = convertStringToDate($param)->getTimestamp();
        return (new DateTime(date('Y-m-1', $date)));
    }
}

/**
 * Retorna o ultimo dia do mês
 */
if (!function_exists('lastDayOfMonth')) {

    function lastDayOfMonth($param)
    {
        $date = convertStringToDate($param)->getTimestamp();
        return (new DateTime(date('Y-m-t', $date)));
    }
}

/**
 * Recebe as horas em formato de TIME ex: 232123421 e converte para hora normal 00:50:30
 */
if (!function_exists('convertTimeToHour')) {

    function convertTimeToHour($param)
    {
        $h = intdiv($param, 3600);
        $m = intdiv($param % 3600, 60);
        $s = $param - ($h * 3600) - ($m * 60);
        return sprintf("%02d:%02d:%02d", $h, $m, $s);
    }
}




