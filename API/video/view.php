<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json; charset=utf-8');
include "../config/Database.php";
include "../objects/User.php";
$conn = new Database();
$user = new User($conn);
//if(!isset($_POST["session_token"])) {
//    print_r(json_encode(array(
//        "success" => "false",
//        "message" => "No session token provided."
//    )));
//    die();
//}
$sessiontoken = $_POST["session_token"];
//$sessiontoken = '9a45c03c-8d20-4d7e-bb79-09f5acbc1289';
$user->set_session_token($sessiontoken);
$result = $user->return_all_user_vids();
print_r($result);
