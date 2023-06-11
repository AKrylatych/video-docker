<?php
include "../Libs/API-interface.php";
include "../Libs/Domain.php";

var_dump($_POST);
$email = isset($_POST['email']) ? $_POST['email'] : die();
$password = isset($_POST['password']) ? $_POST['password'] : die();

//$url = getdomain(apiDomain) . "/user/login.php";
$url = getdomain(apiDomain) . "/apitest/curlsend_test.php";
$paramArray = array(
    "email" => $email,
    "password" => $password
);
//var_dump($url);
echo "<br>";
var_dump($paramArray);
$result = sendPOST($url, $paramArray);
echo "<br>";
echo "<br>";
var_dump(json_decode($result));