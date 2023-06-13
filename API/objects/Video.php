<?php

include "../config/Database.php";
include "User.php";
include "mailman.php";
class Video
{
    private $session_token;
    private $conn;
    const TARGET_DIR = "../storage/";
    const ALLOWED_FORMATS =  array("mp4", "wmv", "flv", "webm", "avi", "mov", "mkv");

    public function __construct($conn, $session_token) {
        $this->conn = $conn;
        $this->session_token = $session_token;
    }

    function obfuscate_video_name($name):string {
        return str_rot13($name);
    }
    function deobfuscate_video_name($name):string {
        return str_rot13($name);

    }

    function create_fs_video_name(): ?string {
        $query = "SELECT create_video_uuid()";
        $result = pg_query($this->conn->conn, $query);
        $pgobject = pg_fetch_object($result);
        if (!$pgobject) { return NULL; }
        return $pgobject->create_video_uuid;
    }

    function video_vardump($INPUT_VIDEOS) {
        echo "<br><br><br>";
        echo "video vardump";
        var_dump($INPUT_VIDEOS);
        echo "<br><br><br>";
    }

    function create_database_video_record($uid, $title, $fsname): bool {
        $query = "SELECT public.new_video_record('$uid', '$title', '$fsname')";
        $result = pg_query($this->conn->conn, $query);
        $pgobject = pg_fetch_object($result);
        if (!$result || !$pgobject) {
            return false;
        } else {
            return true;
        }
    }

    function delete_video($name)
    {
        $query = "DELETE FROM public.video_storage
        WHERE video_file_name = '$name'";
        $result = pg_query($this->conn->conn, $query);
        echo "result is: " . print_r($result);
        var_dump($result);
        $pgobject = pg_fetch_object($result);
        var_dump($pgobject);
        if (!$result || !$pgobject) {
            echo "so the query is wrong";
            var_dump($result);
            echo "<hr>";
            var_dump($pgobject);
            return json_encode(array(
                "success" => "false"
            ));
        } else {
            unlink("../storage/$name");
            echo "sike it works!";
            return json_encode(array(
                "success" => "true"
            ));
        }

    }


    function upload_video($VIDEO):string {
        $user = new User($this->conn);
        $user->set_session_token($this->session_token);
        if (!$user->validate_session_token()) {
            return json_encode(array(
                "success" => "false",
                "message" => "Invalid session token. Please log in."
            ));
        }

        $uploadOk = 1;
        $hiddenVideoName = $this->create_fs_video_name();
        $target_file = self::TARGET_DIR . $hiddenVideoName;
        $videoFileType = strtolower(pathinfo($VIDEO["name"], PATHINFO_EXTENSION));
        $output = NULL;
        if (!in_array($videoFileType, self::ALLOWED_FORMATS)) {
            $output = array(
                "success" => "false",
                "message" => "Sorry, only MP4, AVI, MOV, and MKV files are allowed."
            );
            $uploadOk = 0;
        }

        if ($uploadOk === 1 && move_uploaded_file($VIDEO["tmp_name"], $target_file)) {
            $output = array(
                "success" => "true",
                "message" => "The file " . basename($VIDEO["name"]) . " has been uploaded.",
                "vidname" => $hiddenVideoName
            );
            $mail = new Mailman();
            $mail->send_upload_mail($user->email, "New upload", "Your video is: $hiddenVideoName");
            // Uploading that video records to database

            $obfuscated_name = $this->obfuscate_video_name(basename($VIDEO["name"]));
            $userid = $user->get_uid_from_session();
            if (!$userid) {
                $output = array(
                    "success" => "false",
                    "message" => "Failed getting uid from session.",
                );
            }
            $result = $this->create_database_video_record($userid, $obfuscated_name, $hiddenVideoName);
            if (!$result) {
                $output = array(
                  "success" => "false",
                  "message" => "Failed uploading record to database."
                );
            }


        } else {
            $output = array(
                "success" => "false",
                "message" => "Failed to upload file."
            );
        }
        return json_encode($output);

    }
    function upload_video_array($INPUT_VIDEOS):string {
        $user = new User($this->conn);
        $user->set_session_token($this->session_token);
        if (!$user->validate_session_token()) {
            return json_encode(array(
                "success" => "false",
                "message" => "Invalid session token. Please log in."
            ));
        }

        $jsonfinal = array();
        foreach ($INPUT_VIDEOS as $VIDEO) {
            $uploadOk = 1;
            $hiddenVideoName = $this->create_fs_video_name();
            $target_file = self::TARGET_DIR . $hiddenVideoName;
            $videoFileType = strtolower(pathinfo($VIDEO["name"], PATHINFO_EXTENSION));
            $output = NULL;
            if (!in_array($videoFileType, self::ALLOWED_FORMATS)) {
                $output = array(
                    "success" => "false",
                    "message" => "Sorry, only MP4, AVI, MOV, and MKV files are allowed."
                );
                $uploadOk = 0;
            }

            if ($uploadOk === 1 && move_uploaded_file($VIDEO["tmp_name"], $target_file)) {
                $output = array(
                    "success" => "true",
                    "message" => "The file " . basename($VIDEO["name"]) . " has been uploaded.",
                    "vidname" => $hiddenVideoName
                );
            } else {
                $output = array(
                    "success" => "false",
                    "message" => "Failed to upload file."
                );
            }
            $jsonfinal[] = $output;
        }
        return json_encode($jsonfinal);
    }
}