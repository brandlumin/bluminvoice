<?php
  $fCrfCust = $_POST["form-crf-cust"]; $fCrfProjectID = $_POST["form-crf-projectID"]; $fCrfProject = $_POST["form-crf-project"]; $fCrfDate = $_POST["form-crf-date"]; $fCrfDesc = $_POST["form-crf-desc"]; $fCrfAmount = $_POST["form-crf-amount"];

  /* setting the query */
  $query = "INSERT INTO changeMaster(prjID, changeReq, changeDate, changeAmount) VALUES ('$fCrfProjectID' ,'$fCrfDesc' ,'$fCrfDate' ,'$fCrfAmount')";

  /* establishing connection */
  @include "consql.php";

  /* firing the query through connection */
  $response = mysqli_query($connection, $query);

  /* Closing DB connection */
  mysqli_close($connection);

  /* Check result if successful */
  if ($response) {
    /* if successful */
    header("location: change-request.php?success");
  } else {
    /* if unsuccessful */
    header("location: change-request.php?error=".mysqli_connect_error(). " " .mysqli_error($connection));
  }
?>