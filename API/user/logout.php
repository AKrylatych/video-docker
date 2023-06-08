<?php
header('Content-Type: application/json; charset=utf-8');

include_once "../objects/User.php";
include_once "../config/Database.php";

$conn = new Database();
$user = new User($conn);

$user->set_session_token(isset($_GET['token']) ? $_GET['token'] : die());
if ($user->logout_user()) {
    $output = array(
        "success" => "true",
        "message" => "Logged out successfully."
    );
} else {
    $output = array(
        "success" => "false",
        "message" => "Log out out failed. Is the database reachable?"
    );
}
print_r(json_encode($output));


