<?php
  define('DB_SERVER', 'localhost:3306');
  define('DB_USERNAME', 'root');
  define('DB_PASSWORD', 'Container@1');
  define('DB_DATABASE', 'blvoice');
  $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

  // Check connection
  if (mysqli_connect_errno()) {
    header('Content-type: text/plain');
    printf("Connect failed: %s\n", mysqli_connect_error());
    // exit();
  }
  if (!$db) {
    header('Content-type: text/plain');
    die("Could not connect due to error# " . mysqli_connect_errno());
  }
  echo "Connected successfully";
  mysqli_close($db);

  /* Not working God Knows Why
  if (!mysql_ping($db)) {
    header('Content-type: text/plain');
    echo "Connection Closed.";
  }*/
?>