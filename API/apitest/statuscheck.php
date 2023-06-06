<?php
$text = isset($_GET['text']) ? $_GET['text'] : die();

$output = array(
    "text" => $text
);
print_r(json_encode($output));