<?php


error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once "../objects/User.php";
include_once "../config/Database.php";

$conn = new Database();
$conn->getConnection();
$user = new User($conn);

$user->email = isset($_GET['email']) ? $_GET['email'] : die();
$user->password = isset($_GET['password']) ? $_GET['password'] : die();
$user->login_user($user->email, $user->password);
//
//if ($user->login_user($user->email, $user->password)) {
//    $output = array(
//        "success" => "true",
//        "message" => "Logged in successfully."
//    );
//} else {
//    $output = array(
//        "success" => "false",
//        "message" => "Failed to log in."
//    );
//}
//print_r(json_encode($output));


