<?php

function sendPOST($url, $paramArray): string {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    // Set the request type to POST
    curl_setopt($curl, CURLOPT_POST, true);
    // Set the POST data
    curl_setopt($curl, CURLOPT_POSTFIELDS, $paramArray);
    curl_setopt($curl, CURLOPT_HEADER, false);


    $data = curl_exec($curl);
    if ($data === false) {
        $error = curl_error($curl);
        $data =  array("error" => "Error sending cURL request:" . $error);
    }
    curl_close($curl);
    return $data;
}