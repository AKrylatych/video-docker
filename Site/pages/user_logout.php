<?php
setcookie('session_token', "", time() - 10, "/");
echo "Cookies obliterated: " . $_COOKIE['session_token'];
echo "<script>window.location.href='../index.php'</script>";
