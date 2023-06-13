<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <meta charset="utf-8">
    <title>Titulinis</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/headers/">
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="styles/headers.css" rel="stylesheet">
  </head>
  <body>
<main>
  <div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
      <div class="col-md-3 mb-2 mb-md-0">
        <a href="#" class="d-inline-flex link-body-emphasis text-decoration-none">
          <img src="images/image9446.svg" width="150px">
        </a>
      </div>

      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="#" class="nav-link px-2 link-secondary">Pagrindinis</a></li>
        <li><a href="pages/apie.php" class="nav-link px-2">Apie</a></li>
          <?php
          if (isset($_COOKIE['session_token']) && $_COOKIE['session_token'] != "") {

              $block = <<<HTML
                         <li><a href="pages/video_vidlist.php" class="nav-link px-2">Video</a></li>
                    HTML;
              echo $block;
          } else {
              $block = <<<HTML
                         <li><a href="pages/user_login.php" class="nav-link px-2">Video</a></li>
                    HTML;
              echo $block;
          }
          ?>
        <li><a href="pages/duk.php" class="nav-link px-2">D.U.K</a></li>
      </ul>
        <?php
        if (isset($_COOKIE['session_token']) && $_COOKIE['session_token'] != "") {
            $block = <<<HTML
                <div class="col-md-3 text-end">
                    <button onclick="window.location.href='pages/user_logout.php'" type="button" id="register" class="btn btn-primary">Atsijungti</button>
                </div>
                HTML;
            echo $block;

        } else {
            $block = <<<HTML
                <div class="col-md-3 text-end">
                    <button onclick="window.location.href='pages/user_login.php'" type="button" id="login" class="btn btn-outline-primary me-2">Prisijungti</button>
                    <button onclick="window.location.href='pages/user_register.php'" type="button" id="register" class="btn btn-primary">Registruotis</button>
                </div>
                HTML;
            echo $block;
        }
        ?>
    </header>
      <div class="px-4 pt-5 my-5 text-center border-bottom">
          <h1 class="display-4 fw-bold text-body-emphasis">Saugokite savo klipus</h1>
          <div class="col-lg-6 mx-auto">
              <p class="lead mb-4">Paprastai ir greitai saugokite savo klipus, dalinkites jais su kitais! Niekada taip paprasta dar nebuvo!</p>
          </div>
          <div class="overflow-hidden" style="max-height: 50vh;">
              <div class="container px-5">
                  <img src="images/DALL·E%202023-06-12%2023.38.31%20-%20server%20room%20realistic.png" class="img-fluid border rounded-3 shadow-lg mb-4" alt="Example image" width="700" height="500" loading="lazy">
              </div>
          </div>
      </div>
    <div class="container col-xxl-8 px-4 py-5">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="images/server-security-1666200049.jpg" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">Saugumas ir garantuotas patogumas</h1>
                <p class="lead">Naudodami savo patentuota MaxiCool technologiją, galime užtikrinti jūsų duomenų saugumą ir konfidencialumą. <br> Duomenis šifruojame vienpusiais šifravimo algoritmais, kurių nulaužimui reiktų milijonus metų</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <button type="button" onclick="window.location.href='pages/user_register.php'" class="btn btn-primary btn-lg px-4 me-md-2">Prisijunk!</button>
                </div>
            </div>
        </div>
    </div>

</main>

    </body>
</html>
