<?php
header('Content-Type: application/json');
$output = array(
    "text" => "You're supposed to see this"
);
print_r(json_encode($output));
