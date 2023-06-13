<?php

include "../Libs/API-interface.php";
include "../Libs/Domain.php";

if($_FILES != NULL) {
    $url = getdomain(apiDomain) . "/video/upload.php";
    $tmpfile = $_FILES['fileToUpload']['tmp_name'];
    $filename = basename($_FILES['fileToUpload']['name']);
    $mime = $_FILES['fileToUpload']['type'];
    $session_token = $_COOKIE['session_token'];
    $paramArray = array(
        'fileToUpload' => curl_file_create($tmpfile, $mime, $filename),
        'session_token' => $session_token
    );
//    $result = json_decode(sendPOST($url, $paramArray));
    $result = json_decode(sendPOST($url, $paramArray));
    echo "<video src='http://storage.video-docker.online/" . $result->vidname . "'>";
} else if(!isset($_POST["session_token"])) {
    print_r(json_encode(array(
        "success" => "false",
        "message" => "No valid login token provided. Please input a valid session token."
    )));
} else {
    print_r(json_encode(array(
        "success" => "false",
        "message" => "No files submitted."
    )));
}

