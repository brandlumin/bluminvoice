<?php
  $work = $_REQUEST["work"];

  switch ($work) {
    case "Projects":
      echo "you called: " . $work;
      break;
    case "AccMgrs":
      echo "you called: " . $work;
      break;
    case "Nothing":
      echo "Your favorite color is nothing!";
      break;
    default:
      echo "Your favorite color is something else!";
  }

    // @include_once "consql.php";
    // $accList = mysqli_query($connection, "SELECT `accID`, `accName`, `accDesignation` FROM `accountMaster` WHERE `custID` = $CustomerID ORDER BY `accName` ASC");
    // mysqli_close($connection);
    // echo "<option value='' disabled selected>Select the Account Manager or Project SPOC...</option>";
    // while($row=mysqli_fetch_array($accList)) {
    //   echo "<option value='".$row[accID]."'>".$row[accName]." (".$row[accDesignation].")</option>";
    // }
  }

?>