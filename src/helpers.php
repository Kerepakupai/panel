<?php

if (! function_exists('dd')) {
    function dd($message)
    {
        print "<pre>";
        print_r($message);
        print "</pre>";

        exit();
    }
}

if (! function_exists('business_days')) {
    function business_days($start_date, $end_date, $holidays_days = array()) {

    }
}


function getWorkdays($date1, $date2, $workSat = FALSE, $patron = NULL) {
    if (!defined('SATURDAY')) define('SATURDAY', 6);
    if (!defined('SUNDAY')) define('SUNDAY', 0);

    // Obtengo los dias feriados de la Base de Datos
    // Array of all public festivities
    $publicHolidays = array('01-01', '01-06', '04-25', '05-01', '06-02', '08-15', '11-01', '12-08', '12-25', '12-26');
    // The Patron day (if any) is added to public festivities
    if ($patron) {
        $publicHolidays[] = $patron;
    }
    /*
     * Array of all Easter Mondays in the given interval
     */
    $yearStart = date('Y', strtotime($date1));
    $yearEnd   = date('Y', strtotime($date2));
    for ($i = $yearStart; $i <= $yearEnd; $i++) {
        $easter = date('Y-m-d', easter_date($i));
        list($y, $m, $g) = explode("-", $easter);
        $monday = mktime(0,0,0, date($m), date($g)+1, date($y));
        $easterMondays[] = $monday;
    }
    $start = strtotime($date1);
    $end   = strtotime($date2);
    $workdays = 0;
    for ($i = $start; $i <= $end; $i = strtotime("+1 day", $i)) {
        $day = date("w", $i);  // 0=sun, 1=mon, ..., 6=sat
        $mmgg = date('m-d', $i);
        if ($day != SUNDAY &&
            !in_array($mmgg, $publicHolidays) &&
            !in_array($i, $easterMondays) &&
            !($day == SATURDAY && $workSat == FALSE)) {
            $workdays++;
        }
    }
    return intval($workdays);
}

function getHolidays($date1, $date2) {
    $results = DB::select( DB::raw ("SELECT CONCAT(month(date),'-', day(date)) FROM global_holidays WHERE date between '$date1' and '$date2'"));
}

function convertMinutesToDaysHoursMinutes($minutes)
{
    $days = 0;
    $hours = 0;
    if ($minutes > 59) {
        $hours = floor($minutes / 60);
        $minutes = $minutes % 60;
        if ($hours >= 9 ) {
            $days = floor($hours / 9);
            $hours = $hours % 9;
        }
    } elseif ($minutes < 0) {
        $minutes = 0;
    }

    dd($days . ' dias ' . $hours . ' horas y ' . $minutes. ' minutos');

}

function convert_date_es_to_en($date)
{
    if (strlen($date) < 10) return "";
    $date = self::left($date, 10);
    $date = str_replace("-", "/", $date);
    if ($date == '00/00/0000') return "";
    $parts = explode("/", $date);
    return $parts[2] . '-' . $parts[1] . '-' . $parts[0];
}

function left($string, $count){
    return substr($string, 0, $count);
}

function handleDate($date)
{
    if ($date === null || ctype_alpha(substr($date, 0, 2))) {
        $date = '21/06/2017';
    }

    $delimiter = (! strpos($date, '/'))
        ? '-' : '/';

    $date_formated = explode($delimiter, $date);

    try {
        if ($date_formated[1] > 12) {
            $aux = $date_formated[0];
            $date_formated[0] = $date_formated[1];
            $date_formated[1] = $aux;
        }

        $day = str_pad($date_formated[0], 2, 0, STR_PAD_LEFT);
        $month = str_pad($date_formated[1], 2, 0, STR_PAD_LEFT);
        $year = $date_formated[2];
        if(strlen($year) == 2)
            $year = '20' . $date_formated[2];

        $dateFormated = $year . '-' . $month . '-' . $day;

        return new Carbon($dateFormated, 'America/Santiago');

        // dd($newCustomer->last_mng);
    } catch (\Exception $e) {
        // echo $e;
        return Carbon::now('America/Santiago');
    }

    return true;
}