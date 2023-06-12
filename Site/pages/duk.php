<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
    <script src="../assets/js/color-modes.js"></script>
    <meta charset="utf-8">
    <title>Titulinis</title>
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
                <li><a href="apie.php" class="nav-link px-2 ">Apie</a></li>
                <?php
                if (isset($_COOKIE['session_token']) && $_COOKIE['session_token'] != "") {

                    $block = <<<HTML
                         <li><a href="../videocontrol/video_listing.php" class="nav-link px-2">Video</a></li>
                    HTML;
                    echo $block;
                } else {
                    $block = <<<HTML
                         <li><a href="user_login.php" class="nav-link px-2">Video</a></li>
                    HTML;
                    echo $block;
                }
                ?>

                <li><a href="#" class="nav-link px-2 link-secondary">D.U.K</a></li>
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


</main>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
