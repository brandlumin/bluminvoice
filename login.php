<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png">
    <link rel="manifest" href="./site.webmanifest">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="styles/bootstrap.css" />
    <link rel="stylesheet" href="styles/bluminvoice.css" />
    <title>Login : bluminVoice</title>
  </head>

  <body class="bl__home d-flex flex-column justify-content-between">
    <?php @include_once "header.html" ?>
    <main role="main" class="container flex-fill d-flex flex-column justify-content-center">
      <section class="jumbotron bg-transparent bl__home_login">
        <div class="row">
          <div class="col-sm-6 offset-sm-3">
            <form class="needs-validation rounded-lg bg-light" accept-charset="UTF-8" action="./login_page.php" method="post" id="form-login" name="form-login" novalidate>
              <div class="mx-5 mt-5 mb-5">
                <img class="mx-auto d-block" src="images/bl-logo.svg" alt="" height="50px" />
                <h5 class="text-center">Invoicing System</h5>
              </div>
              <h4 class="text-center my-5">Login</h4>
              <div class="row mx-5 my-3">
                <div class="col-12 text-center">
                  <input type="password" class="form-control text-center border-bottom" placeholder="P@s$w0rD*" id="login-password" name="login-password" required />
                </div>
              </div>
              <div class="row mx-5 mt-3 mb-5">
                <div class="col-12 text-center">
                  <button class="btn btn-primary btn-block no-shadow-hover">
                    Login
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </section>
    </main>
    <?php @include_once "footer.html" ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="scripts/preload.js"></script>
    <script src="scripts/script6es.js"></script>
  </body>

</html>