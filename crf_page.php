<?php
  $fCrfCust = $_POST["form-crf-cust"]; $fCrfCustID = $_POST["form-crf-custID"]; $fCrfProjectID = $_POST["form-crf-projectID"]; $fCrfProject = $_POST["form-crf-project"]; $fCrfDate = $_POST["form-crf-date"]; $fCrfDesc = $_POST["form-crf-desc"]; $fCrfAmount = $_POST["form-crf-amount"];

  /**
   *    INSERTING CHANGE-REQUEST INTO THE DATABASE
   *    SELECT  FROM ``
   *    
   */
  // setting the query
  $query = "INSERT INTO `changeMaster`(`custID`, `prjID`, `changeReq`, `changeDate`, `changeAmount`) VALUES ('$fCrfCustID' ,'$fCrfProjectID' ,'$fCrfDesc' ,'$fCrfDate' ,'$fCrfAmount')";

  // establishing connection
  @include "consql.php";

  // firing the query through connection
  $response = mysqli_query($connection, $query);

  // Closing DB connection
  mysqli_close($connection);

  echo $response;

  // Check result if successful
  if ($response) {
    // if successful
    header("location: change-request.php?success");
  } else {
    // if unsuccessful
    header("location: change-request.php?error=".mysqli_connect_error(). " " .mysqli_error($connection));
  }
?>