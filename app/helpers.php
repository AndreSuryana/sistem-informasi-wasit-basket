<?php

if (!function_exists('format_date')) {
    function format_date(string $date, string $format)
    {
        // Creating timestamp from given date
        $timestamp = strtotime($date);

        // Creating new date format from that timestamp
        $new_date = date($format, $timestamp);
        
        return $new_date;
    }
}
