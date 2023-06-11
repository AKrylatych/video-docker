<?php

include "../objects/Video.php";

if($_FILES != NULL) {
    $session_token = $_POST["sessiontoken"];
    $conn = new Database();
    $vid = new Video($conn, $session_token);
    $vid->upload_video($_FILES);
} else if(isset($_POST["seshtoken"])) {
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

//echo "<video src='../storage/" . basename($_FILES["fileToUpload"]["name"]) . "'>";