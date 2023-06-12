<?php
if (isset($_COOKIE["session_token"])) {

} else {
    header("Location: ../pages/user_login.php");
}
