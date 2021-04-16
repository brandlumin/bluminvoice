<?php 

// capturing data in variables 
$fCmfCust = $_POST["form-cmf-name"]; $fCmfAddr1 = $_POST["form-cmf-addr1"]; $fCmfAddr2 = $_POST["form-cmf-addr2"]; $fCmfAddr3 = $_POST["form-cmf-addr3"]; $fCmfCity = $_POST["form-cmf-city"]; $fCmfState = $_POST["form-cmf-state"]; $fCmfPin = $_POST["form-cmf-pin"]; $fCmfGstin = $_POST["form-cmf-gstin"]; $fCmfGstType = $_POST["form-cmf-gst-type"];

/**
 *    INSERTING CUSTOMER INTO THE DATABASE
 */

// setting the query
$query = "INSERT INTO customerMaster(custName, custAddr1, custAddr2, custAddr3, custCity, custState, custPin, custGSTIN, custType) VALUES ('$fCmfCust', '$fCmfAddr1', '$fCmfAddr2', '$fCmfAddr3', '$fCmfCity', '$fCmfState', '$fCmfPin', '$fCmfGstin', '$fCmfGstType')";

// establishing connection
@include "consql.php";

// firing the query through connection
$response = mysqli_query($connection, $query);

// Closing DB connection
mysqli_close($connection);

// Check result if successful
if ($response) {
  // if successful
  header("location: customer-master.php?success");
} else {
  // if unsuccessful
  header("location: customer-master.php?error=".mysqli_connect_error(). " " .mysqli_error($connection));
}

?>