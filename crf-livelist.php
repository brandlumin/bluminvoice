<?php
  @include_once "consql.php";

  if(isset($_REQUEST["term"])) {
    /* Prepare a select statement */
    $searchQuery = "SELECT A.`prjName`, A.`prjID`, A.`prjStartDate`, A.`prjInvoiceID`, C.`custName`, C.`custID` FROM assgMaster A INNER JOIN customerMaster C ON A.`custID` = C.`custID` WHERE A.`IsInvoiced` = 0 AND A.`prjName` LIKE ?";

      if($statement = mysqli_prepare($connection, $searchQuery)) {
      /* Bind variables to the prepared statement as parameters */
      mysqli_stmt_bind_param($statement, "s", $param_term);

      /* Set parameters */
      $param_term = '%' . $_REQUEST["term"] . '%';

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
  }
  /* Closing DB connection */
  mysqli_close($connection);
?>