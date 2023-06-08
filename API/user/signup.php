<?php
header('Content-Type: application/json; charset=utf-8');
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once "../objects/User.php";
include_once "../config/Database.php";
$conn = new Database();
$conn->getConnection();
$user = new User($conn);

$user->email = isset($_GET['email']) ? $_GET['email'] : die();
$user->password = isset($_GET['password']) ? $_GET['password'] : die();
$user->password = password_hash($user->password, PASSWORD_BCRYPT);

if ($user->new_user($user->email, $user->password)) {
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
header('Content-Type: application/json; charset=utf-8');

print_r(json_encode($output));


