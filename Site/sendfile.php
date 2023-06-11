<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>file sending test page</title>
</head>
<body>
<?php
if (!isset($_COOKIE['sessiontoken'])) {
    echo "you need to log in first!";
    echo "<a href='index.html'>Login</a>";
} else {

    echo '<form action="http://api.video-docker.online/apitest/uploadtest.php" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
  <input type="hidden" name="sessiontoken">
</form>';

}

?>


</body>
</html>