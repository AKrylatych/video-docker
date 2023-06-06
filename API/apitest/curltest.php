<?php
$output = array(
"text" => "You're supposed to see this"
);
header('Content-Type: application/json');
print_r(json_encode($output));