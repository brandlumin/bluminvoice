<?php 

/* capturing data in variables  */
$fAmfCust = $_POST["form-amf-cust"]; $fAmfName = $_POST["form-amf-name"]; $fAmfDesig = $_POST["form-amf-desig"]; $fAmfAddr1 = $_POST["form-amf-addr1"]; $fAmfAddr2 = $_POST["form-amf-addr2"];
if (isset($_POST["form-amf-addr3"])) { $fAmfAddr3 = $_POST["form-amf-addr3"];} 
$fAmfCity = $_POST["form-amf-city"]; $fAmfState = $_POST["form-amf-state"]; $fAmfPin = $_POST["form-amf-pin"]; $fAmfPhones = $_POST["form-amf-phones"]; $fAmfEmail = $_POST["form-amf-email"];

/* setting same OR different address */
$fAmfUseCustAddr = ($_POST["form-amf-usecustaddr"] == "on") ? 1 : 0;

/**
 *    INSERTING ACCOUNT INTO THE DATABASE
 */

/* setting the query (IF this OR that) */
$query = ($fAmfUseCustAddr) ? "INSERT INTO accountMaster(custID, accName, accDesignation, useCustAddr, accPhone, accEmail) VALUES ('$fAmfCust', '$fAmfName', '$fAmfDesig', $fAmfUseCustAddr, '$fAmfPhones', '$fAmfEmail')" : "INSERT INTO accountMaster(custID, accName, accDesignation, useCustAddr, accAddr1, accAddr2, accAddr3, accCity, accState, accPin, accPhone, accEmail) VALUES ('$fAmfCust', '$fAmfName', '$fAmfDesig', $fAmfUseCustAddr, '$fAmfAddr1', '$fAmfAddr2', '$fAmfAddr3', '$fAmfCity', '$fAmfState', '$fAmfPin', '$fAmfPhones', '$fAmfEmail')";

/* establishing connection */
@include "consql.php";

/* firing the query through connection */
$response = mysqli_query($connection, $query);

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

?>