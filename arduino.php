<?php
// This file is required for the Wemos D1 Mini & OLED Shield to work
// As this isn't protected, you might want to use a long, random name

// Start MySQL Connection
include('dbconnect.php');
?>
<?php
$Day = date("D");

$q = $pdo->prepare("SELECT $Day FROM INR ORDER BY Date desc LIMIT 1");
$q->execute();

$result = $q->fetchColumn();
  ?>
<?php echo $result ?>mg
<?php
  $pdo = null;
?>
