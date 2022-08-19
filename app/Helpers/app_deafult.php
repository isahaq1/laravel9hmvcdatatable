<?php
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Modules\Setting\Entities\Setting;


function sendSuccessResponse($message, $result, $code=200){
    $resposnse = [
        'success'   =>true,
        'code'      =>$code,
        'message'   =>$message,
        'data'      =>$result
    ];

    return response()->json($resposnse, $code);
}

function sendErrorResponse($errorMessage, $errorData=null, $code=404){
    
    $resposnse = [
        'success'   => false,
        'code'      => $code,
        'message'   => $errorMessage,
        'data'      => @$errorData
    ];

    return response()->json($resposnse, $code);
}


/*
Date dd/mm/yyyy to yyyy-mm-dd conversion
*/
function date_db_format($date)
{
    if ($date == '') {
        return $date;
    }
    return implode("-", array_reverse(explode("/", $date)));
}


/*
Date to day conversion
*/
function date_to_day($date)
{
    $day = date('D',strtotime($date));
    return $day;
}


/*
Date Format
*/
function dateformat($date)
{
    if ($date == '') {
        return $date;
    }

    $date =date('Y-m-d H:i:s', strtotime($date));
   
    return $date;
}



function uniqueId($limit=null)
{
    return time();
    //return mt_rand(1000000000,9999999999);
}


function appSetting(){
    return Setting::first();
}


function getUser(){
    return Auth::user();
}


// Get table max ID
if (!function_exists('getMAXID')) {

    function getMAXID($table, $column)
    {
        if (!empty($table)) {
           $row = DB::table($table)->max($column);
            if (!empty($row)) {
                return $row + 1;
            } else {
                return 1;
            }
        } else {
            return false;
        }
    }
}


