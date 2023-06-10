<?php

include "../objects/Video.php";

$target_dir = "../storage/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$videoFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$allowedFormats = array("mp4", "wmv", "flv", "webm", "avi", "mov", "mkv"); // Add your desired movie formats here


$vid = new Video();
if(isset($_POST["submit"]) && $_FILES != NULL) {
    echo "Hey you submitted something!";
    if (!in_array($videoFileType, $allowedFormats)) {
        echo "Sorry, only MP4, AVI, MOV, and MKV files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk === 1 && move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $output = array(
            "success" => "true",
            "message" => "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.",
            "vidname" => $vid->obfuscate_video_name(basename($_FILES["fileToUpload"]["name"]))
        );
    } else {
        $output = array(
            "success" => "false",
            "message" => "Failed to upload file."
        );
    }
}
print_r($output);

echo "<video src='../storage/" . basename($_FILES["fileToUpload"]["name"]) . "'>";