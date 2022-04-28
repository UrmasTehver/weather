<?php

/** Shows array */
function show($array)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

/** Convert date YYYY-MM-DD HH:MM:SS to DD.MM.YYYY HH:MM:SS */
function dbDateToEstDateClock($date)
{
    return date('d.m.Y H:i:s', strtotime($date));
}

/** Convert date YYYY-MM-DD to DD.MM.YYYY */
function dbDateToEstDate($date)
{
    return date('d.m.Y', strtotime($date));
}

/** Convert date YYYY-MM-DD to DD.MM */
function dbDateToEstDateOnly($date)
{
    return date('d.m.', strtotime($date));
}

/** Convert date YYYY-MM-DD HH:MM:SS => YYYY-MM-DD */
function dbDateRemoveClock($date)
{
    return date('Y-m-d', strtotime($date));
}

/** Convert date YYYY-MM-DD => YYYY */
function onlyYear($date)
{
    return date('Y', strtotime($date));
}

/** Convert date YYYY-MM-DD => MM-DD */
function onlyDate($date)
{
    return date('m-d', strtotime($date));
}

/** Create array of dates for reading from database */
function datesToRead($startdate, $enddate)
{
    $datestoread = [];
    $startyear = onlyYear($startdate);
    $endyear = onlyYear($enddate);
    $date = onlyDate($enddate);
    for ($startyear; $startyear <= $endyear; $startyear++) {
        $x = $startyear . '-' . $date;
        array_push($datestoread, $x);
    }
    return $datestoread;
}


/** Get mindate for Datepicker calendar settings */
function minDateToDatepicker($date1, $date2)
{
    $datetime1 = new DateTime($date1);
    $datetime2 = new DateTime($date2);
    $difference = $datetime1->diff($datetime2);
    return (0 - ($difference->days));
}
