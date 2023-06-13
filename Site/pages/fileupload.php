<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <title>Apie</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/headers/">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="../styles/headers.css" rel="stylesheet">
</head>
<body>
<main>
    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <img src="../images/image9446.svg" width="150px">
                </a>
            </div>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="../index.php" class="nav-link px-2 ">Pagrindinis</a></li>
                <li><a href="apie.php" class="nav-link px-2 link-secondary">Apie</a></li>
                <?php
                if (isset($_COOKIE['session_token']) && $_COOKIE['session_token'] != "") {

                    $block = <<<HTML
                         <li><a href="video_vidlist.php" class="nav-link px-2">Video</a></li>
                    HTML;
                    echo $block;
                } else {
                    $block = <<<HTML
                         <li><a href="user_login.php" class="nav-link px-2">Video</a></li>
                    HTML;
                    echo $block;
                }
                ?>
                <li><a href="duk.php" class="nav-link px-2">D.U.K</a></li>
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
    <div class="px-4 pt-5 my-5 text-center border-bottom">
        <h1 class="display-4 fw-bold text-body-emphasis">Failo siuntimas</h1>
        <div class="col-lg-6 mx-auto">
            <?php

            include "../Libs/API-interface.php";
            include "../Libs/Domain.php";

            if($_FILES != NULL) {
                $url = getdomain(apiDomain) . "/video/upload.php";
                $tmpfile = $_FILES['fileToUpload']['tmp_name'];
                $filename = basename($_FILES['fileToUpload']['name']);
                $mime = $_FILES['fileToUpload']['type'];
                $session_token = $_COOKIE['session_token'];
                $paramArray = array(
                    'fileToUpload' => curl_file_create($tmpfile, $mime, $filename),
                    'session_token' => $session_token
                );
//    $result = json_decode(sendPOST($url, $paramArray));
                $result = json_decode(sendPOST($url, $paramArray));
                if ($result->success == "true") {
                    echo "Failas nusiųstas sėkmingai";
                }
            } else if(!isset($_COOKIE["session_token"])) {
                print_r(json_encode(array(
                    "success" => "false",
                    "message" => "No valid login token provided. Please input a valid session token."
                )));
            } else {
                print_r(json_encode(array(
                    "success" => "false",
                    "message" => "No files submitted."
                )));
            }
            ?>

        </div>

    </div>

</main>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>




