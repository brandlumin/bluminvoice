    <title>LOGIN : bluminvoice</title>
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