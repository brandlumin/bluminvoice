<?php 
  @include "consql.php";
  if (isset($_POST["customerID"]) && !empty($_POST["customerID"])) {
    $CustomerID = $_POST["customerID"];
    // Confirming what did we capture
    // showing JS alert from PHP
    // echo '<script type="text/javascript">alert("We got: '.$CustomerID.'");</script>';

    // get all the account managers
    $accList = mysqli_query($connection, "SELECT `custID`, `accID`, `accName` FROM `accountMaster` WHERE `custID` = $CustomerID ORDER BY `accName` ASC");
    // Closing DB connection
    mysqli_close($connection);
    // populating the data into options
    if(mysqli_num_rows($accList) > 0 ) {
      echo "<option value=0 selected>Select the Account Manager or Project SPOC...</option>";
      while($row=mysqli_fetch_array($accList)) {
        echo "<option value=$row[accID]>$row[accName]</option>";
      }
    } else {
      echo "<option disabled value=0 selected>Account Manager not found in the system.</option>";
    }
  } else {
    echo "<option value=0 selected>Select the Account Manager...</option>";
  }
?>