<?php

if(isset($_REQUEST["task"])) {
  $task = $_REQUEST["task"];
} else {
  echo json_encode(array("ERROR"=>"brandlumin reports that TASK was not passed to this module."));
  return;
}
if(isset($_REQUEST["prjSearch"])) {
  $value = $_REQUEST["prjSearch"];
} else {
  echo json_encode(array("ERROR"=>"brandlumin reports that PROJECT was not passed to this module."));
  return;
}

  if ($task == "QuickList") {
    quickDetail($value);
  } elseif ($task == "FullList") {
    /* echo "task: ".$task." prjSearch: ".$value; */
    fullDetail($value);
  } else {
    echo json_encode(array("ERROR"=>"brandlumin reports that some error occured."));
    return;
  }

  function quickDetail($value) {
    require 'consql.php';
    /* Prepare a select statement */ $searchQuery = "SELECT A.prjID, A.prjName FROM assgMaster A JOIN (SELECT B.prjID FROM assgMaster B WHERE B.isInvoiced = 0 UNION ALL SELECT I.prjID FROM invoiceMaster I WHERE I.isPaid = 0) C ON A.prjID = C.prjID WHERE A.prjName LIKE ? ORDER BY A.prjName ASC";
    if($statement = mysqli_prepare($connection, $searchQuery)) {
      /* Bind variables to the prepared statement as parameters */
      mysqli_stmt_bind_param($statement, "s", $param_term);
      /* Set parameters */
      $param_term = '%' . $value . '%';
      /* Attempt to execute the prepared statement */
      if(mysqli_stmt_execute($statement)) {
        $result = mysqli_stmt_get_result($statement);
        /* Check number of rows in the result set */
        if(mysqli_num_rows($result) > 0) {
          /* Fetch result rows as an associative array */
          while( $row = mysqli_fetch_array($result, MYSQLI_ASSOC) ) {
            echo "<p proj-id='$row[prjID]'>$row[prjName]</p>";
          }
        } else {
          echo "<p onclick='return false;' class=text-danger>No matches found</p>";
        }
      } else {
        echo "ERROR: Could not execute $searchQuery. " . mysqli_error($connection);
      }
    }
    /* Close statement */
    mysqli_stmt_close($statement);
    /* Closing DB connection */
    mysqli_close($connection);
  }

  function fullDetail($value) {
    require 'consql.php';
    $changeHistory = ""; $changeAmount = "";
    /* SELCET STATEMENT */ $assgMasterQuery = mysqli_query($connection, "SELECT A.prjID, A.prjName PROJECT, A.prjInvoiceID INVOICE, B.custName CUSTOMER, C.accName MANAGER, A.prjStartDate STARTED, A.prjEndDate ENDED, A.isInvoiced, A.prjDesc DESCRIPTION, A.prjNarr NARRATION, A.prjCostQuoted QUOTED, B.custType, D.invDate, D.prjTotalBill TOTAL, D.isPaid, D.prjBillDetails BILLING FROM assgMaster A JOIN customerMaster B ON A.custID = B.custID JOIN accountMaster C ON A.accID = C.accID LEFT JOIN invoiceMaster D ON A.prjID = D.prjID WHERE A.prjID =". $value);
    while( $row=mysqli_fetch_assoc($assgMasterQuery) ) {
      /* expecting single row */
      $asgMasterDetails = array( "fullPrjInv" => $row );
    }

    /* SELCET STATEMENT */ $chgMasterQuery = mysqli_query($connection, "SELECT changeDate, changeReq, changeAmount FROM changeMaster WHERE prjID = ". $value); /* from the TABLE changeMaster */
    while( $rowChg=mysqli_fetch_assoc($chgMasterQuery) ) {
      /* multiple rows possible */
      $changeHistory .= "Date: ".$rowChg[changeDate]."\n"."Change Request: ".$rowChg[changeReq]."\n"."Amount: ".$rowChg[changeAmount]."\n---------------- ----------------\n";
      $changeAmount += $rowChg[changeAmount];
    }
    $chgMasterDetails = array( "fullChanges" => ["chgHistory" => $changeHistory,"chgAmount" => $changeAmount]);

    mysqli_close($connection);
    $completeDetails = array_merge(
      (!empty($asgMasterDetails)) ? $asgMasterDetails : array(), 
      (!empty($chgMasterDetails)) ? $chgMasterDetails : array()
    );
    
    echo json_encode($completeDetails);
  }

  function showVarr($arr) { 
    if ($arr == "-") { echo nl2br("---- ---- ---- ---- ---- ----\n\n"); return; }
    echo '<pre>'; print_r($arr); echo '</pre>'; 
  }
?>