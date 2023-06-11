<?php
include "Libs/API-interface.php";

$email = isset($_GET['email']) ? $_GET['email'] : die();
$password = isset($_GET['password']) ? $_GET['password'] : die();
