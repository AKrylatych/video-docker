<?php
header('Content-Type: application/json; charset=utf-8');
include "../objects/Video.php";
if(isset($_POST["session_token"]) && isset($_POST["videoname"])) {
    $session_token = $_POST["session_token"];
    $vidname = $_POST["videoname"];
    $conn = new Database();
    $vid = new Video($conn, $session_token);
    $result = $vid->delete_video($vidname);
    print_r($result);

} else if(!isset($_POST["session_token"])) {
    print_r(json_encode(array(
        "success" => "false",
        "message" => "No valid login token provided. Please input a valid session token."
    )));
} else {
    print_r(json_encode(array(
        "success" => "false",
        "message" => "No videoname "
    )));
}