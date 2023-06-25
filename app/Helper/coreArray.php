<?php

use App\Http\Boilerplate\CustomResponse;
use Carbon\Carbon;

function dateConvertert($inputDate,$inputDateFormat,$outputDateFormat){
    return
    Carbon::createFromFormat($inputDateFormat,  $inputDate)->format($outputDateFormat);
}

function jsonResponse($type = TRUE)
{
    return new CustomResponse($type);
}

function calculateDateDifference($date_from, $date_to, $delimiter = " ")
{
    $time_diff_array = [];
    $time_diff_str = "";
    $diff = abs($date_to - $date_from);
    $years = floor($diff / (365 * 60 * 60 * 24));
    if ($years > 0) {
        $time_diff_array['year'] = $years;

        if ($years == 1) {
            $time_diff_str .= $years . " Years" . $delimiter;
        } else {
            $time_diff_str .= $years . " Years" . $delimiter;
        }
    }
    $months = floor(($diff - $years * 365 * 60 * 60 * 24)
        / (30 * 60 * 60 * 24));
    if ($months > 0) {
        $time_diff_array['months'] = $months;

        if ($months == 1) {
            $time_diff_str .= $months . " Month" . $delimiter;
        } else {
            $time_diff_str .= $months . " Months" . $delimiter;
        }
    }

    $days = floor(($diff - $years * 365 * 60 * 60 * 24 -
        $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
    if ($days > 0) {
        $time_diff_array['days'] = $days;
        if ($days == 1) {
            $time_diff_str .= $days . " Day" . $delimiter;
        } else {
            $time_diff_str .= $days . " Days" . $delimiter;
        }
    }
    $hours = floor(($diff - $years * 365 * 60 * 60 * 24
    - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
    if ($hours > 0) {
        $time_diff_array['hours'] = $hours;
        if ($hours == 1) {
            $time_diff_str .= $hours . " Hour" . $delimiter;
        } else {
            $time_diff_str .= $hours . " Hours" . $delimiter;
        }
    }
    $minutes = floor(($diff - $years * 365 * 60 * 60 * 24
    - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24                            - $hours * 60 * 60) / 60);
    if ($minutes > 0) {
        $time_diff_array['minutes'] = $minutes;
        if ($minutes == 1) {
            $time_diff_str .= $minutes . " Minute" . $delimiter;
        } else {
            $time_diff_str .= $minutes . " Minutes" . $delimiter;
        }
    }

    $seconds = floor(($diff - $years * 365 * 60 * 60 * 24
    - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24
        - $hours * 60 * 60 - $minutes * 60));
    if ($seconds > 0) {
        $time_diff_array['seconds'] = $seconds;
        if ($seconds == 1) {
            $time_diff_str .= $seconds . " Second" . $delimiter;
        } else {
            $time_diff_str .= $seconds . " Seconds" . $delimiter;
        }
    }
    return  $time_diff_str;
  
}

