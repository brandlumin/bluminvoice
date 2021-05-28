<?php
include 'consql.php';
session_start();
// error_reporting(0);

if (isset($_SESSION['idfy'])) {
  header("Location: login.php"); // if successful: goto this page
}
if (isset($_POST['submit'])) {
  $idfy = $_POST['username']; $password = md5($_POST['password']); $cpassword = md5($_POST['cpassword']); // variables
  if ($password == $cpassword) {
    $validDupQuery = "SELECT * FROM `whoCanAccess` WHERE `idfy`='$idfy'"; // query
    $doesExist = mysqli_query($connection, $validDupQuery); // connection
    if (mysqli_num_rows($doesExist) == 0) { // does not exist
      $registerQuery = "INSERT INTO `whoCanAccess`(`idfy`, `supportive`) VALUES ('$idfy', '$password')"; // query
      $result = mysqli_query($connection, $registerQuery); // connection
      mysqli_close($connection); // connection closed
      if ($result) {
        $validity = 1;
        // SUCCESS MESSAGE has been shifted after the button in HTML
      } else {
        $validity = 2;
        // ERROR MESSAGE has been shifted after the button in HTML
      }
    } else {
      $validity = 3;
      // ERROR MESSAGE has been shifted after the button in HTML
    } 
  } else {
    $validity = 4;
    // ERROR MESSAGE has been shifted after the button in HTML
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
    <title>Register : bluminvoice</title>
  </head>

  <body class="bl__home d-flex flex-column justify-content-between bg-secondary">
    <?php // @include_once "header.html" ?>
    <main role="main" class="container flex-fill d-flex flex-column justify-content-center">
      <section class="bl__home_login">
        <div class="row">
          <div class="col-sm-6 offset-sm-3">
            <form autocomplete="off" class="needs-validation rounded-lg bg-light" accept-charset="UTF-8" action="" method="post" id="form-login" name="form-login" novalidate>
              <img class="mx-auto d-block mt-5" src="images/bl-logo.svg" alt="" height="50px" />
              <div class="mx-5 my-4">
                <h5 class="text-center">Registration: Invoicing System</h5>
              </div>
              <div class="row mx-5 my-3">
                <div class="col-12 text-center">
                  <input type="text" class="form-control text-center border-bottom mb-2" placeholder="username" id="username" name="username" value="<?php (isset($idfy)) ? $idfy : ''; ?>" required />
                  <input type="password" class="form-control text-center border-bottom mb-2" placeholder="p@s$W0rD*" id="password" name="password" value="<?php (isset($password)) ? $_POST['password'] : ''; ?>" required />
                  <input type="password" class="form-control text-center border-bottom" placeholder="confirm your p@s$W0rD*" id="cpassword" name="cpassword" value="<?php (isset($cpassword)) ? $_POST['cpassword'] : ''; ?>" required />
                </div>
              </div>
              <div class="row mx-5 mt-5 mb-5">
                <div class="col-12 text-center">
                  <button name="submit" class="btn btn-primary btn-block no-shadow-hover">Register</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <?php
          if (isset($validity) && $validity == 1) {
            echo "<div class='alert alert-success alert-dismissible fade show position-absolute center-vertical' role='alert'><center class='text-center font-weight-bold'>Login created successfully.</center>Please go back to the <a href='./'>login page</a> now.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            // header("Location: login.php");
          } elseif (isset($validity) && $validity == 2) {
            echo "<div class='alert alert-danger alert-dismissible fade show position-absolute center-vertical' role='alert'><center class='text-center font-weight-bold'>Error encountered:</center>Something went wrong. Please retry.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
          } elseif (isset($validity) && $validity == 3) {
            echo "<div class='alert alert-danger alert-dismissible fade show position-absolute center-vertical' role='alert'><center class='text-center font-weight-bold'>Error encountered:</center>This user already exists. Please choose a different user.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
          } elseif (isset($validity) && $validity == 4) {
            echo "<div class='alert alert-danger alert-dismissible fade show position-absolute center-vertical' role='alert'><center class='text-center font-weight-bold'>Error encountered:</center>Passwords did not match in the form.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
          }
        ?>
      </section>
    </main>
    <?php @include_once "footer.html" ?>