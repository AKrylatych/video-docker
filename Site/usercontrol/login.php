<?php
include "../Libs/API-interface.php";
include "../Libs/Domain.php";

if (isset($_POST['email'])) {
    $email = $_POST['email'];
} else {
    print_r(json_encode(array(
        "success" => "false",
        "message" => "email not supplied."
    )));
    die();
}
if (isset($_POST['password'])) {
    $password = $_POST['password'];
} else {
    print_r(json_encode(array(
        "success" => "false",
        "message" => "email not supplied."
    )));
    die();
}

$url = getdomain(apiDomain) . "/user/login.php";
$paramArray = array(
    "email" => $email,
    "password" => $password
);
$result = json_decode(sendPOST($url, $paramArray));
if ($result->success == "true") {
    $session_token_expiry = strtotime($result->session_token_expiry);

    setcookie("session_token", $result->session_token, $session_token_expiry, "/");
    echo "Prisijungta sėkmingai!";
    echo "<a href='../index.html'>Back to index</a>";

} else {
    echo "Klaidingas prisijungimas!";
    echo "<a href='../index.html'>Back to index</a>";
}
