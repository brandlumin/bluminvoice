<?php
// $work = $_REQUEST["work"];
if(isset($_REQUEST["work"])) $work = $_REQUEST["work"];
if(isset($_REQUEST["value"])) $value = $_REQUEST["value"];
if(isset($_REQUEST["recDate"])) $recDate = $_REQUEST["recDate"];

switch ($work)
{
  case "findProjectForInvoice":
    searchProject();
    break;
  case "findProjectDetailForInvoice":
    expandProject();
    break;
  case "markReceivePayment":
    receivePayment();
    break;
  default:
    echo "You have used it in a wrong way! Please check deeply.";
}

function receivePayment(/*$value="", $recDate=""*/)
{
  if(isset($_REQUEST["value"])) $value = $_REQUEST["value"];
  if(isset($_REQUEST["recDate"])) $recDate = $_REQUEST["recDate"];

    /**
     *    INSERTING INVOICE INTO THE DATABASE
     *    SELECT  FROM ``
     *    
     */
    // setting the query

    $invMasterQuery = "UPDATE `invoiceMaster` SET `prjPaidDate`= '$recDate', `isPaid`=1 WHERE `prjID`= '$value'";

    // establishing connection
    @include "consql.php";

    // firing the assignment UPDATE query through connection
    $invResponse = mysqli_query($connection, $invMasterQuery); 

    // Closing DB connection
    mysqli_close($connection);

    // Check result if successful
    if ($invResponse) {
      // if successful
      $paymentStatus="payment received";
    } else {
      // if unsuccessful
      $paymentStatus = "error=" . mysqli_connect_error(). " " .mysqli_error($connection);
    }
    echo json_encode($paymentStatus);

}

/**
 *    INVOICE-MASTER-FORM DATA
 *    @return JSON object
 */
function expandProject() {
  if(isset($_REQUEST["value"])) {
    $value = $_REQUEST["value"];
    @include_once "consql.php";
    /* SELCET STATEMENT */ $assgMasterQuery = mysqli_query($connection, "SELECT A.`prjName`, A.`prjDesc`, A.`prjNarr`, A.`prjStartDate`, A.`prjEndDate`, A.`prjCostQuoted`, A.`isInvoiced`, C.`custType` FROM `assgMaster` A JOIN `customerMaster` C ON A.`custID` = C.`custID` WHERE `prjID` = ". $value);
    while( $row=mysqli_fetch_assoc($assgMasterQuery) ) { // expecting single row
      $isInvoiced = $row[isInvoiced];
      $asgMasterDetails = array( "assignment" => $row );
    }
    // showVarr($asgMasterDetails); showVarr($isInvoiced);
    /* SELCET STATEMENT */ $chgMasterQuery = mysqli_query($connection, "SELECT `changeID`, `changeDate`, `changeReq`, `changeAmount` FROM `changeMaster` WHERE `prjID` = ". $value); // from the TABLE changeMaster
      while( $rowChg=mysqli_fetch_assoc($chgMasterQuery) ) { // multiple rows possible
        $changeHistory .= "Date: ".$rowChg[changeDate]."\n"."Change Request: ".$rowChg[changeReq]."\n"."Amount: ".$rowChg[changeAmount]."\n---------------- ----------------\n";
        $changeAmount += $rowChg[changeAmount];
      }
      $chgMasterDetails = array( "changes" => 
        ["chgHistory" => $changeHistory,"chgAmount" => $changeAmount]
      );
      // showVarr($chgMasterDetails);
    if ( $isInvoiced == 1) { // if invoice has been generated
      /* SELCET STATEMENT */ $invMasterQuery = mysqli_query($connection, "SELECT `invDate`, `prjTotalBill`, `prjBillDetails`, `isPaid`, `prjPaidDate` FROM `invoiceMaster` WHERE `prjID` = ". $value); // from the TABLE invoiceMaster
      mysqli_close($connection);
      while( $rowInv=mysqli_fetch_assoc($invMasterQuery) ) { // expecting single row
        $invMasterDetails = array( "invoice" => $rowInv );
      }
      // showVarr($invMasterDetails);
    } else {
      mysqli_close($connection);
    }
    $completeDetails = array_merge(
      (!empty($asgMasterDetails)) ? $asgMasterDetails : array(), 
      (!empty($invMasterDetails)) ? $invMasterDetails : array(), 
      (!empty($chgMasterDetails)) ? $chgMasterDetails : array(), 
    );
    echo json_encode($completeDetails);
  }
}

/**
 *    LIVE-SEARCH DATA: SUPPLIES PROJECT LIST FOR THE DROPDOWN
 *    @return list of projects contained within a <p> tag
 */
function searchProject() {
  @include_once "consql.php";
  if(isset($_REQUEST["value"])) {
      // Prepare a select statement
    $searchQuery = "SELECT A.prjName, A.prjID, A.accID, C.custName, C.custID, Z.accName, A.prjInvoiceID, A.prjStartDate FROM `assgMaster` A INNER JOIN `customerMaster` C ON A.custID = C.custID INNER JOIN `accountMaster` Z ON A.accID = Z.accID WHERE A.prjName LIKE ?";
    if($statement = mysqli_prepare($connection, $searchQuery)) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($statement, "s", $param_term);
      // Set parameters
      $param_term = '%' . $_REQUEST["value"] . '%';
      // Attempt to execute the prepared statement
      if(mysqli_stmt_execute($statement)) {
        $result = mysqli_stmt_get_result($statement);
        // Check number of rows in the result set
        if(mysqli_num_rows($result) > 0) {
          // Fetch result rows as an associative array
          while( $row = mysqli_fetch_array($result, MYSQLI_ASSOC) ) {
            echo "<p acct-id='$row[accID]' proj-id='$row[prjID]' cust-id='$row[custID]' acct-name='$row[accName]' cust-name='$row[custName]' invo-id='$row[prjInvoiceID]' date-strt='$row[prjStartDate]'>$row[prjName]</p>";
          }
        } else {
          echo "<p onclick='return false;' class=text-danger>No matches found</p>";
        }
      } else {
        echo "ERROR: Could not execute $searchQuery. " . mysqli_error($connection);
      }
    }
    // Close statement
    mysqli_stmt_close($statement);
  }
  // Closing DB connection
  mysqli_close($connection);
}

/**
 *    TO DISPLAY THE VARIABLE NICELY
 *    @param  $arr - the Variable to print
 */
function showVarr($arr) { 
  if ($arr == "-") { echo nl2br("---- ---- ---- ---- ---- ----\n\n"); return; }
  echo '<pre>'; 
  print_r($arr); 
  echo '</pre>'; 
  }
?>