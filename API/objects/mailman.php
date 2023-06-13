<?php

Class Mailman {

        function send_upload_mail($user, $subject, $msg) {
        mail($user, $subject, $msg);
    }
}
