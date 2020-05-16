<?php

/* Firebase_notifications_fcm
 * To use the function you need to have ($tokens, $data , $google_api_key)
 * $google_api_ke after create an app in firebase you need to find Google Api Key
 * $tokens an Array with devices tokens
 * $data must be multidimensional array with the data you will send with ( title , message ) for example 
 */


function Firebase_notifications_fcm($tokens, $data, $google_api_key)
{
    $url = 'https://fcm.googleapis.com/fcm/send';
    $fields = array(
        'registration_ids' =>   $tokens   ,
        'data' => $data,
    );
    define("GOOGLE_API_KEY", $google_api_key );
    $headers = array(
        'Authorization: key=' . GOOGLE_API_KEY,
        'Content-Type: application/json'
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    if ($result === FALSE) {
        die('Curl failed: ' . curl_error($ch));
    }
    curl_close($ch);
    return $result;
}
