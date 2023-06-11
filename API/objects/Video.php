<?php

include "../config/Database.php";
include "User.php";
class Video
{
    private $sessiontoken;
    private $conn;
    const TARGET_DIR = "../storage/";
    const ALLOWED_FORMATS =  array("mp4", "wmv", "flv", "webm", "avi", "mov", "mkv");

    public function __construct($conn, $sessiontoken) {
        $this->conn = $conn->conn;
        $this->sessiontoken = $sessiontoken;
    }

    function obfuscate_video_name($name):string {
        return str_rot13($name);
    }
    function deobfuscate_video_name($name):string {
        return str_rot13($name);

    }
    function create_db_record() {

    }
    function upload_video($INPUT_VIDEOS):string {

        $user = new User($this->conn);
        if (!$user->validate_session_token()) {
            return json_encode(array(
                "success" => "false",
                "message" => "Invalid session token. Please log in."
            ));
        }

        $jsonfinal = array();
        foreach ($INPUT_VIDEOS as $VIDEO) {
            $uploadOk = 1;
            $hiddenVideoName = $this->obfuscate_video_name((basename($VIDEO["fileToUpload"]["name"])));
            $target_file = self::TARGET_DIR . $hiddenVideoName;
            $videoFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            if (!in_array($videoFileType, self::ALLOWED_FORMATS)) {
                $output = array(
                    "success" => "false",
                    "message" => "Sorry, only MP4, AVI, MOV, and MKV files are allowed."
                );
                $uploadOk = 0;
            }
            if ($uploadOk === 1 && move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {


                $output = array(
                    "success" => "true",
                    "message" => "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.",
                    "vidname" => $this->obfuscate_video_name(basename($_FILES["fileToUpload"]["name"]))
                );
            } else {
                $output = array(
                    "success" => "false",
                    "message" => "Failed to upload file."
                );
            }
            $jsonfinal = array_push($jsonfinal, $output);
        }
        return json_encode($jsonfinal);
    }
}