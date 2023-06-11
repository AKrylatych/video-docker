<?php

function sendPOST($url, $paramArray): string {
    echo "PARAM ARRAY: ", var_dump($paramArray);
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    // Set the request type to POST
    curl_setopt($curl, CURLOPT_POST, true);
    // Set the POST data
    curl_setopt($curl, CURLOPT_POSTFIELDS, $paramArray);
    curl_setopt($curl, CURLOPT_HEADER, false);

    $data = curl_exec($curl);
    curl_close($curl);
    return json_encode($data);
}