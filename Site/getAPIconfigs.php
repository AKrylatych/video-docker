<?php
include "Libs/API-interface.php";
$url = 'http://api.video-docker.online/apitest/important_configs.php';
print_r(json_decode(sendPOST($url, "")));