<?php
header('Content-Type: application/json; charset=utf-8');

include_once "../objects/User.php";
include_once "../config/Database.php";

$conn = new Database();
$user = new User($conn);

$user->set_user_email(isset($_POST['email']) ? $_POST['email'] : die());
$user->set_user_password(isset($_POST['password']) ? $_POST['password'] : die());
if ($user->new_user()) {
    $output = array(
        "success" => "true",
        "message" => "Created new user."
    );
} else {
    $output = array(
        "success" => "false",
        "message" => "Failed to create user."
    );
}

print_r(json_encode($output));


