<?php
include "Libs/API-interface.php";
$url = 'http://api.video-docker.online/apitest/important_configs.php';
$result = sendPOST($url, "");
print_r($result);