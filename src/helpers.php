<?php

if (! function_exists('dd')) {
    function dd($message)
    {
        print "<pre>";
        print_r($message);
        print "</pre>";
    }
}
