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
