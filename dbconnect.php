<?php
// Try to keep this file out of the main website folder

$MyHostname = "YOUr HOSTNAME";    // this is usually "localhost" unless your database resides on a different server
$MyUsername = "YOUR USERNAME";  // enter your username for mysql
$MyPassword = "YOUR PASSWORD";  // enter your password for mysql
$dbName     = "YOUR DATABASE";  // eter your database table name from mysql

$db = mysqli_connect("$MyHostname","$MyUsername","$MyPassword","$dbName");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>
