<?php
echo "POST:";
print_r($_POST);
echo "<br><br>";
echo "FILES:";
print_r($_FILES);
header('Content-Type: application/json; charset=utf-8');
include "../objects/Video.php";
echo "TEST";
if($_FILES != NULL && isset($_POST["session_token"])) {
    $session_token = $_POST["session_token"];
    $conn = new Database();
    $vid = new Video($conn, $session_token);
    print_r($vid->upload_video($_FILES));
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