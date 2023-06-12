<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>file sending test page</title>
</head>
<body>
<?php
if (!isset($_COOKIE['session_token'])) {
    echo "you need to log in first!";
    echo "<a href='index.php'>Login</a>";
} else {
    echo "<br><br>";
    echo '<form action="videocontrol/video_upload.php" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
  <input type="hidden" name="sessiontoken" value="'. $_COOKIE['session_token'] .'">
</form>';

}

?>
</body>
</html>