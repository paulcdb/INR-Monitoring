<?php
session_start(); /* Starts the session */
// Try to keep this out of the main folder
include('password.php');

if(!isset($_SESSION['UserData']['Username'])) { ?>

<p>Sorry, you need to login to view this webpage.</p>
<form action="" method="post" name="Login_Form">
<?php if(isset($msg)){
echo $msg;
}

} else {
  if (empty($_GET)) {
    $period = 6;
} else {
    $period = $_GET['period'];
}
?>

<!Doctype html>
<html>
<head>
  <title>INR - Graph</title>
</head>
<body>
<?php include('nav.php'); ?>
  <h3><center>INR Graph (<?php echo $period?> Month)</center></h3>
  <p align="center"><a href="graph.php?period=3">3 Month</a> / <a href="graph.php?period=6">6 Month</a> / <a href="graph.php?period=9">9 Month</a> / <a href="graph.php?period=12">12 Month</a></p>
  <center><img src="YOUR GRAPH URL?period=<?php echo $period ?>" /></center>

<h2><a href=\"logout.php\">Logout</a></h2>
<?php
  }
?>
</body>
</html>

