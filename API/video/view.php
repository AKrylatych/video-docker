<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//header('Content-Type: application/json; charset=utf-8');
include "../config/Database.php";
include "../objects/User.php";
echo "don't<br>";
$conn = new Database();
$user = new User($conn);
echo "stop me now<br>";
//if(!isset($_POST["session_token"])) {
//    return json_encode(array(
//        "success" => "false",
//        "message" => "No session token provided."
//    ));
//}
//$sessiontoken = $_POST["session_token"];
$sessiontoken = '87c783ff-273d-4ad7-b99b-ab2dba334f1f';
echo "beans";
$user->set_session_token($sessiontoken);
$result = $user->return_all_user_vids();
echo "am i getting this?";
var_dump(json_decode($result));
