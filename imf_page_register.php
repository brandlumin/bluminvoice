<?php
  /*"form-imf", "form-imf-proj", "form-imf-cust", "form-imf-acct" <------- THESE ARE ONLY DISPLAY NAMES TYPES */
  $fImfProjID = $_POST["form-imf-projID"]; $fImfInvoice = $_POST["form-imf-invoice"]; $fImfCustID = $_POST["form-imf-custID"]; $fImfAcctID = $_POST["form-imf-acctID"]; $fImfDtstrt = $_POST["form-imf-dtstrt"]; $fImfDtend = $_POST["form-imf-dtend"]; $fImfDtpay = $_POST["form-imf-dtpay"]; $fImfDesc = $_POST["form-imf-desc"]; $fImfNarr = $_POST["form-imf-narr"]; $fImfCrfhistory = $_POST["form-imf-crfhistory"]; $fImfQprice = $_POST["form-imf-qprice"]; $fImfCrftotal = $_POST["form-imf-crftotal"]; $fImfTotal = $_POST["form-imf-total"];  $fImfBilling = $_POST["form-imf-billing"]; $fImfCgst = $_POST["form-imf-cgst"]; $fImfSgst = $_POST["form-imf-sgst"]; $fImfIgst = $_POST["form-imf-igst"]; $fImfGtot = $_POST["form-imf-gtot"];
  if ($fImfCgst == "") $fImfCgst = 0; if ($fImfSgst == "") $fImfSgst = 0; if ($fImfIgst == "") $fImfIgst = 0;

  /* setting the query */
  echo "fImfProjID: " . $fImfProjID . nl2br("<br/>");
  $assgMasterQuery = "UPDATE assgMaster SET prjEndDate= '$fImfDtend', isInvoiced=1 WHERE prjID= '$fImfProjID'";
  echo "assgMasterQuery: " . $assgMasterQuery . nl2br("<br/>");

  $invMasterQuery = "INSERT INTO invoiceMaster(prjID, invDate, prjTotalBill, cgst, sgst, igst, prjGrandTotal, prjBillDetails) VALUES ('$fImfProjID', '$fImfDtend', '$fImfTotal', '$fImfCgst', '$fImfSgst', '$fImfIgst', '$fImfGtot', '$fImfBilling')";
  echo "invMasterQuery: " . $invMasterQuery;

  /* establishing connection */
  @include "consql.php";

  /*firing the assignment  UPDATE query through connection */
  $assgResponse = mysqli_query($connection, $assgMasterQuery);

  if ($assgMasterQuery) {
  /* If successful */
    /*firing the  invoice query through connection */
    $invResponse = mysqli_query($connection, $invMasterQuery); 
  }

  /* Closing DB connection */
  mysqli_close($connection);


  if ($invResponse) {
    /* if successful */
    header("location: invoice-master.php?generate=success");
  } else {
    /* if unsuccessful */
    header("location: invoice-master.php?error=".mysqli_error($connection));
  }

?>