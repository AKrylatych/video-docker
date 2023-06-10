<?php
header('Content-Type: application/json; charset=utf-8');

include "../config/Domain.php";
$postMaxSize = ini_get('post_max_size');
$uploadMaxFilesize = ini_get('upload_max_filesize');

print_r($output = array(
    "post_max_size" => "$postMaxSize",
    "upload_max_filesize" => "$uploadMaxFilesize",
    "rootDomain" => rootDomain
));