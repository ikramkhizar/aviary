<?php

namespace App\Helpers;

use Carbon\Carbon;

class CommonFunction
{
    public static function show_date($date, $format='d-m-Y <\b\r> h:i a') 
    {
        $timezone = 'Asia/Karachi';
        return $date->setTimezone($timezone)->format($format);
    }

    public function get_date_diff($date)
    {
        $diff = '';

        $date = Carbon::parse($date);
        $now  = Carbon::now();

        $interval = $date->diff($now);

        if ($interval->y != 0) {
            if ($interval->y > 1) {
                $diff = $interval->y.' Years';
            } else {
                $diff = $interval->y.' Year';
            }
        } else if ($interval->m != 0) {
            if ($interval->m > 1) {
                $diff = $interval->m.' Months';
            } else {
                $diff = $interval->m.' Month';
            } 
        } else if ($interval->d != 0) {
            if ($interval->d > 1) {
                $diff = $interval->d.' Days';
            } else {
                $diff = $interval->d.' Day';
            }
        }
        
        return $diff;
    }
}
