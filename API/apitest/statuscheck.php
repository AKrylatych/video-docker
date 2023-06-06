<?php
$text = isset($_GET['text']) ? $_GET['text'] : die();

$output = array(
    "text" => $text
);
print_r(json_encode($output));

echo "<br><br>we doin good now <br>";
file_get_contents("http://api.video-docker.online/apitest/curltest.php");
echo "<br><br>we doin good now <br>";
