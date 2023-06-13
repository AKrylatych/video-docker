<?php

include "../Libs/API-interface.php";
include "../Libs/Domain.php";

$url = getdomain(apiDomain) . "/user/logout.php";
$paramArray = array(
    "session_token" => $_COOKIE['session_token'],
);
$result = json_decode(sendPOST($url, $paramArray));
if ($result->success == "true") {
    setcookie('session_token', "", time() - 10, "/");
    echo "Cookies obliterated: " . $_COOKIE['session_token'];
    echo "<script>window.location.href='../index.php'</script>";

} else {
    echo "something's wrong";
    echo "<script>window.location.href='../index.php'</script>";
}


