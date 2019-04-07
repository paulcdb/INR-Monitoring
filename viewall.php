<?php 
session_start(); /* Starts the session */
include('password.php');
?>
<!Doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="description" content="$1">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>INR - All Records</title>


</head>
<body>
<?php
// Start MySQL Connection
include('dbconnect.php');

if(!isset($_SESSION['UserData']['Username'])) { ?>

<p>Sorry, you need to login to view this webpage.</p>
<form action="" method="post" name="Login_Form">
<?php if(isset($msg)){
echo $msg;
}
?>
<div class="form_row"><label>Username</label><input class="inputfield" name="Username" type="text" /></div>
<div class="form_row"><label>Password</label><input class="inputfield" name="Password" type="password" /></div>
<input class="button" name="Submit" type="submit" value="Login" />
</form>

<?php } else { ?>
<p align="center" style="font-size:12px"><a href=index.php>Add INR</a> - <a href=daily.php>Daily Dose</a> - <a href=graph.php>Graph</a> - <a href=viewall.php>View All</a>
<p><h1><center>Showing All Records</h1></p>
<?php
$stmt = $pdo->query('SELECT Date, INR, Total, Days FROM INR ORDER BY Date desc');
foreach ($stmt as $row)
{
  // $num_padded = sprintf("%02d", $num);
    echo substr( $row['Date'],0,10 ) . " - (" . sprintf("%02d", $row['Days']) . " Days) - ";
  if ($row['INR'] < 3.0) {
    $Calc = $row['INR']-3.0;
    echo $row['INR'] . " - Weekly: " . $row['Total'] . "mg - <font color='RED'>LOW (Under by: " . $Calc . ")</font><hr width='7.5%' align='left'>";
    } 
  elseif ($row['INR'] > 4.5) {
    $Calc = $row['INR']-4.5;
    echo $row['INR'] . " - Weekly: " . $row['Total'] . "mg - <font color='RED'>HIGH (Over by: " . $Calc . ")</font><hr width='7.5%' align='left'>";
    }
  else {
    echo $row['INR'] . " - Weekly: " . $row['Total'] . "mg<hr width='7.5%' align='left'>";
  }
}
?>

  <p><b>Note:</b> The weekly mg is an estimate and won't be accurate if the dosage changes on a differant day(s)!</p>
  
<p><a href="logout.php">Logout</a></p>

<?php
}
  //$stmt->close();
  ?>
</body>
</html>
