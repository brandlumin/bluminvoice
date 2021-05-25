<?php
define('DB_SERVER', 'localhost:3306');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'Container@1');
define('DB_DATABASE', 'blvoice');

// establishing the connection -- Procedural style
$connection = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

// die if connection fails
if (!$connection) {
  echo "Error Code: ".mysqli_connect_errno();
  // the following code is working perfectly. commented to extend the usage from within the codes.
  // die("Could not connect due to:<br /><b>" . mysqli_connect_error() ."</b><br/>error code (" . mysqli_connect_errno() . ")");
  // echo "<script type='text/javascript'>console.log($error)</script>";
} else { 
  // echo "<script type=text/javascript>console.log('Database connected.')</script>"; 
}
?>