<?php
  if (isset($_REQUEST["customerID"]) && !empty(isset($_REQUEST["customerID"]))) {
    /**
     *      RETURNS ACCOUNT MANAGERS DROPDOWN ACC. TO THE SELECTED CUSTOMER
     */
    @include "consql.php";
    $CustomerID = $_REQUEST["customerID"];

    /* get all the account managers */
    $accList = mysqli_query($connection, "SELECT `custID`, `accID`, `accName` FROM `accountMaster` WHERE `custID` = $CustomerID ORDER BY `accName` ASC");

    /* Closing DB connection */
    mysqli_close($connection);
    
    /* populating the data into options */
    $acmList = "";
    if(mysqli_num_rows($accList) > 0 ) {
      $acmList .= "<option value='' disabled selected>Select the Account Manager or Project SPOC...</option>";
      while($row=mysqli_fetch_array($accList)) {
        $acmList .= "<option value=$row[accID]>$row[accName]</option>";
      }
    } else {
      $acmList .= "<option value='' disabled selected>Account Manager not found in the system.</option>";
    }
    // header('Content-type: application/json');
    echo json_encode($acmList);
  } else {
    /**
     *      ADDS NEW ASSIGNMENT TO THE DATABASE
     */
    /* capturing data in variables  */
    $fPmfCustID = $_POST["form-pmf-cust"]; $fPmfAccID = $_POST["form-pmf-accm"]; $fPmfName = $_POST["form-pmf-name"]; $fPmfInvoiceID = $_POST["form-pmf-invoice"]; $fPmfDesc = $_POST["form-pmf-desc"]; $fPmfNarr = $_POST["form-pmf-narr"]; $fPmfStartDate = $_POST["form-pmf-start-date"]; $fPmfCostQuoted = $_POST["form-pmf-quote"];

    /* Getting the project ID */
    preg_match('/(\d+)$/', $fPmfInvoiceID, $matches); $fPmfProjID = $matches[1];

    /* setting the query */
    $query = "INSERT INTO `assgMaster`(`custID`, `accID`, `prjName`, `prjID`, `prjInvoiceID`, `prjDesc`, `prjNarr`, `prjStartDate`, `prjCostQuoted`) VALUES ('$fPmfCustID' ,'$fPmfAccID' ,'$fPmfName' ,'$fPmfProjID' ,'$fPmfInvoiceID' ,'$fPmfDesc' ,'$fPmfNarr' ,'$fPmfStartDate' ,'$fPmfCostQuoted')";

    /* establishing connection */
    @include "consql.php";

    /* firing the query through connection */
    $response = mysqli_query($connection, $query);

    /* Closing DB connection */
    mysqli_close($connection);

    /* Check result if successful */
    if ($response) {
      /* if successful */
      header("location: assignment-master.php?success=yes&ID=".$fPmfInvoiceID);
    } else {
      /* if unsuccessful */
      header("location: assignment-master.php?error=".mysqli_connect_error(). " " .mysqli_error($connection));
    }
  }
?>

