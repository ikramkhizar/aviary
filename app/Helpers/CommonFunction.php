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

    public static function get_date_diff($date)
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

    public static function simple_crypt($string, $action = 'e') 
    {
        // you may change these values to your own
        $secret_key = config('app.key');
        $secret_iv =  config('app.key');
  
        $output = false;
        $encrypt_method = config('app.cipher');
        $key = hash( 'sha256', $secret_key );
        $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
  
        if( $action == 'e' ) {
            $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
        }
        else if( $action == 'd' ){
            $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
        }
  
        return $output;
    }
}
