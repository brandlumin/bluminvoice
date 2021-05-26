<?php
include 'consql.php';
session_start();
// error_reporting(0);

if (isset($_SESSION['idfy'])) {
    header("Location: welcome.php"); // if successful: goto this page
}
if (isset($_POST['submit'])) {
  /*$username = $_POST['username'];*/ $password = md5($_POST['password']); // variables
  $validationQuery = "SELECT * FROM `whoCanAccess` WHERE `supportive`='$password' /*AND `idfy`='$username'*/ "; // query
  $result = mysqli_query($connection, $validationQuery); // connection
  mysqli_close($connection); // connection closed
  if (mysqli_num_rows($result) > 0) { // OOP: if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['idfy'] = $row['idfy'];
    header("Location: welcome.php");
  } else {
    echo "<script>fAlert('Ehh!!<br />Wrong credentials.',2400);</script>";
  }
}
?>
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
    <title>LOGIN : bluminvoice</title>
  </head>

  <body class="bl__home d-flex flex-column justify-content-between">
    <?php // @include_once "header.html" ?>
    <main role="main" class="container flex-fill d-flex flex-column justify-content-center">
      <section class="jumbotron bg-transparent bl__home_login">
        <div class="row">
          <div class="col-sm-6 offset-sm-3">
            <form autocomplete="off" class="needs-validation rounded-lg bg-light" accept-charset="UTF-8" action="" method="post" id="form-login" name="form-login" novalidate>
              <img class="mx-auto d-block mt-5" src="images/bl-logo.svg" alt="" height="50px" />
              <div class="mx-5 my-5">
                <h5 class="text-center">Login: Invoicing System</h5>
              </div>
              <div class="row mx-5 my-3">
                <div class="col-12 text-center">
                  <!-- <input type="text" class="form-control text-center border-bottom mb-2" placeholder="username" id="username" name="username" value="<?php /*(isset($username)) ? $username : '';*/ ?>" required /> -->
                  <input type="password" class="form-control text-center border-bottom" placeholder="p@s$W0rD*" id="password" name="password" value="<?php (isset($password)) ? $_POST['password'] : ''; ?>" required />
                </div>
              </div>
              <div class="row mx-5 mt-5 mb-5">
                <div class="col-12 text-center">
                  <button name="submit" class="btn btn-primary btn-block no-shadow-hover">Login</button>
                  <p class="login-register-text mt-2">Don't have an account? <a href="be_a_part.php">Register Here</a>.</p>
                </div>
              </div>
            </form>
          </div>
        </div>
      </section>
    </main>
    <?php @include_once "footer.html" ?>