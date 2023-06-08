<?php
header('Content-Type: application/json; charset=utf-8');

include_once "../objects/User.php";
include_once "../config/Database.php";

$conn = new Database();
$user = new User($conn);

$user->set_user_email(isset($_GET['email']) ? $_GET['email'] : die());
$user->set_user_password(isset($_GET['password']) ? $_GET['password'] : die());
if ($user->login_user()) {
    $output = array(
        "success" => "true",
        "message" => "Login successful. Returning session token and token expiry date",
        "session_token" => $user->session_token,
        "session_token_expiry" => $user->session_token_expiry_date
    );
} else {
    $output = array(
        "success" => "false",
        "message" => "Login failed. User does not exist or password is incorrect.",
        "session_token" => "NULL",
        "session_token_expiry" => "NULL"
    );
}
print_r(json_encode($output));


