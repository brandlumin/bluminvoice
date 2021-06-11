<?php 
  if (isset($_REQUEST["task"])) {
    if(isset($_REQUEST["task"])) {
      $task = $_REQUEST["task"];
    } else {
      echo json_encode(array("ERROR"=>"brandlumin reports that TASK was not passed to this module."));
      return;
    }
    if(isset($_REQUEST["custSearch"])) {
      $value = $_REQUEST["custSearch"];
    } else {
      echo json_encode(array("ERROR"=>"brandlumin reports that CUSTOMER was not passed to this module."));
      return;
    }
    /* establishing connection */
    require "consql.php";
    /* Prepare a select statement */ $custSearchQuery = mysqli_query($connection, "SELECT custAddr1, custAddr2, custAddr3, custCity, custState, custPin FROM customerMaster WHERE custID =". $value);
    while( $row=mysqli_fetch_assoc($custSearchQuery) ) {
      /* expecting single row. capturing the result in an array */
      $custAddressResult = $row ;
    }
    /* Closing DB connection */
    mysqli_close($connection);
    /* Returning the object */
    echo json_encode($custAddressResult);
  } else {
    /* capturing data in variables  */
    $fAmfCust = $_POST["form-amf-cust"]; $fAmfName = $_POST["form-amf-name"]; $fAmfDesig = $_POST["form-amf-desig"]; $fAmfAddr1 = $_POST["form-amf-addr1"]; $fAmfAddr2 = $_POST["form-amf-addr2"];
    if (isset($_POST["form-amf-addr3"])) { $fAmfAddr3 = $_POST["form-amf-addr3"];} 
    $fAmfCity = $_POST["form-amf-city"]; $fAmfState = $_POST["form-amf-state"]; $fAmfPin = $_POST["form-amf-pin"]; $fAmfPhones = $_POST["form-amf-phones"]; $fAmfEmail = $_POST["form-amf-email"];
    /* setting same OR different address */
    $fAmfUseCustAddr = ($_POST["form-amf-usecustaddr"] == "on") ? 1 : 0;
    /* Prepare the INSERT query (IF do_this OR do_that) */ $insertQuery = ($fAmfUseCustAddr) ? "INSERT INTO accountMaster(custID, accName, accDesignation, useCustAddr, accPhone, accEmail) VALUES ('$fAmfCust', '$fAmfName', '$fAmfDesig', $fAmfUseCustAddr, '$fAmfPhones', '$fAmfEmail')" : "INSERT INTO accountMaster(custID, accName, accDesignation, useCustAddr, accAddr1, accAddr2, accAddr3, accCity, accState, accPin, accPhone, accEmail) VALUES ('$fAmfCust', '$fAmfName', '$fAmfDesig', $fAmfUseCustAddr, '$fAmfAddr1', '$fAmfAddr2', '$fAmfAddr3', '$fAmfCity', '$fAmfState', '$fAmfPin', '$fAmfPhones', '$fAmfEmail')";
    /* establishing connection */
    @include "consql.php";
    /* firing the query through connection */
    $response = mysqli_query($connection, $insertQuery);
    /* Closing DB connection */
    mysqli_close($connection);
    /* Check result if successful */
    if ($response) {
      /* if successful */
      header("location: account-master.php?success");
    } else {
      /* if unsuccessful */
      header("location: account-master.php?error=".mysqli_connect_error(). " " .mysqli_error($connection));
    }
  }
?>