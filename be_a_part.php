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
        echo "<script>fAlert('Login created successfully.<br />Please login now.',2400);</script>";
        $idfy = ""; $_POST['password'] = ""; $_POST['cpassword'] = "";
        header("Location: login.php");
      } else {
        echo "<script>fAlert('Ehh!!<br />Something went wrong. Please retry.',2400);</script>";
        echo "<script>alert('Woops! Something Wrong Went.')</script>";
      }
    } else {
      echo "<script>fAlert('Ehh!!<br />This user already exists.',2400);</script>";
      echo "<script>alert('Woops! Email Already Exists.')</script>";
    } 
  } else {
    echo "<script>fAlert('Ehh!!<br />Passwords do not match.',2400);</script>";
    echo "<script>alert('Password Not Matched.')</script>";
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

  <body class="bl__home d-flex flex-column justify-content-between">
    <?php // @include_once "header.html" ?>
    <main role="main" class="container flex-fill d-flex flex-column justify-content-center">
      <section class="jumbotron bg-transparent bl__home_login">
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
      </section>
    </main>
    <?php @include_once "footer.html" ?>