<?php
  $fImfProjID = $_POST["form-imf-projID"]; $fImfDtpay = $_POST["form-imf-dtpay"]; 
  
  /* setting the query */
  $invMasterQuery = "UPDATE `invoiceMaster` SET `prjPaidDate`= '$fImfDtpay', `isPaid`=1 WHERE `prjID`= '$fImfProjID'";

  /* establishing connection */
  @include "consql.php";

  /* firing the assignment UPDATE query through connection */
  $invResponse = mysqli_query($connection, $invMasterQuery); 

  /* Closing DB connection */
  mysqli_close($connection);

  /* Check result if successful */
  if ($invResponse) {
    /* if successful */
    header("location: invoice-master.php?payment=received");
  } else {
    /* if unsuccessful */
    header("location: invoice-master.php?error=".mysqli_connect_error(). " " .mysqli_error($connection));
  }
?>