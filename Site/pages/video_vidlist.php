<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <title>Titulinis</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/headers/">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="../styles/headers.css" rel="stylesheet">
</head>
<body>
<main>
    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="#" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <img src="../images/image9446.svg" width="150px">
                </a>
            </div>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="../index.php" class="nav-link px-2 link-secondary">Pagrindinis</a></li>
                <li><a href="../pages/apie.php" class="nav-link px-2">Apie</a></li>
                <?php
                if (isset($_COOKIE['session_token']) && $_COOKIE['session_token'] != "") {

                    $block = <<<HTML
                         <li><a href="../pages/video_vidlist.php" class="nav-link px-2">Video</a></li>
                    HTML;
                    echo $block;
                } else {
                    $block = <<<HTML
                         <li><a href="../pages/user_login.php" class="nav-link px-2">Video</a></li>
                    HTML;
                    echo $block;
                }
                ?>
                <li><a href="../pages/duk.php" class="nav-link px-2">D.U.K</a></li>
            </ul>
            <?php
            if (isset($_COOKIE['session_token']) && $_COOKIE['session_token'] != "") {
                $block = <<<HTML
                <div class="col-md-3 text-end">
                    <button onclick="window.location.href='user_logout.php'" type="button" id="register" class="btn btn-primary">Atsijungti</button>
                </div>
                HTML;
                echo $block;

            } else {
                $block = <<<HTML
                <div class="col-md-3 text-end">
                    <button onclick="window.location.href='user_login.php'" type="button" id="login" class="btn btn-outline-primary me-2">Prisijungti</button>
                    <button onclick="window.location.href='user_register.php'" type="button" id="register" class="btn btn-primary">Registruotis</button>
                </div>
                HTML;
                echo $block;
            }
            ?>
        </header>
    </div>
    <?php
    echo '<form action="fileupload.php" method="post" enctype="multipart/form-data">';
    echo '<input type="file" class="form-control" name="fileToUpload" id="fileToUpload">';
    echo '<input type="submit" name="submit">';
    echo '</form>';
    ?>

    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    include "../Libs/API-interface.php";
    include "../Libs/Domain.php";
    $paramArray = array(
        "session_token" => $_COOKIE["session_token"],
    );
    $url = getdomain(apiDomain) . "/video/view.php";
    $result = json_decode(sendPOST($url, $paramArray));
    if ($result == NULL) {
        echo "Klaida gaunat vaizdo klipus. Ar jūs jau įkėles vaizdus?";
        die();
    }
        foreach ($result as $key => $video) {
            echo "<br><br>";
            $videotitle = str_rot13($video->video_title);
            $fileurl = "http://storage.video-docker.online/$video->video_file_name";
            echo "<a href=$fileurl>";
            echo "<h3>$videotitle</h3></a>";
            echo '<video width="400" controls>';
            echo'<source src="'.$fileurl.'">';
            echo'</video><br>';
            echo "<form action='filedelete.php' method='post'>";
            echo "<input type='hidden' name='videoname' value=$video->video_file_name>";
            echo "<input type='submit' value='Trinti' name='submit'>";
            echo "</form>";
        }
    ?>
</main>

</body>
</html>
