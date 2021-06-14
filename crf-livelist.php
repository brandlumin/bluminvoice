<?php
if(isset($_REQUEST["task"])) {
  $task = $_REQUEST["task"];
} else {
  echo json_encode(array("ERROR"=>"brandlumin reports that TASK was not passed to this module."));
  return;
}
if(isset($_REQUEST["term"])) {
  $value = $_REQUEST["term"];
} else {
  echo json_encode(array("ERROR"=>"brandlumin reports that PROJECT was not passed to this module."));
  return;
}

  if ($task == "DropDown") {
    dropDown($value);
  } elseif ($task == "LastDate") {
    lastDate($value);
  } else {
    echo json_encode(array("ERROR"=>"brandlumin reports that some error occured."));
    return;
  }

  function dropDown($value) {
    require 'consql.php';
    /* Prepare a select statement */
    $searchQuery = "SELECT A.`prjName`, A.`prjID`, A.`prjStartDate`, A.`prjInvoiceID`, C.`custName`, C.`custID` FROM assgMaster A INNER JOIN customerMaster C ON A.`custID` = C.`custID` WHERE A.`IsInvoiced` = 0 AND A.`prjName` LIKE ?";

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
          while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo "<p proj-id='$row[prjID]' proj-dt='$row[prjStartDate]' cust-id='$row[custID]' cust-name='$row[custName]' proj-in='$row[prjInvoiceID]'>$row[prjName]</p>";
          }
        } else {
          echo "<p onclick='return false;' class=text-danger>No matches found</p>";
        }
      } else {
        echo "ERROR: Could not able to execute $searchQuery. " . mysqli_error($connection);
      }
    }

    /* Close statement */
    mysqli_stmt_close($statement);
    /* Closing DB connection */
    mysqli_close($connection);
  }

  function lastDate($value) {
    require 'consql.php';
    /* SELCET STATEMENT */ $chgDateQuery = mysqli_query($connection, "SELECT changeDate FROM changeMaster A WHERE prjID =". $value ." ORDER BY changeID DESC LIMIT 1");
    while( $row=mysqli_fetch_assoc($chgDateQuery) ) {
      /* expecting single row */
      $chgDate = $row[changeDate];
    }
    /* Closing DB connection */
    mysqli_close($connection);
    echo $chgDate;
  }

?>