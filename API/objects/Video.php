<?php

class Video
{
    function obfuscate_video_name($name):string {
        return str_rot13($name);
    }
    function deobfuscate_video_name($name):string {
        return str_rot13($name);

    }
    function create_db_record() {

    }
    function upload_video() {

    }
}