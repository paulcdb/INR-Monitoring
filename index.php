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

<title>INR - Insert Dosage</title>


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
<?php include('nav.php'); ?>
<?php
$q = $pdo->query("SELECT *, DATE_FORMAT(Date, '%Y/%m/%d') AS DATE FROM INR ORDER BY id DESC LIMIT 1");
$row = $q->fetch();
$datetime1 = new DateTime($row['DATE']);
$datetime2 = new DateTime("now");
$interval = $datetime1->diff($datetime2);
  ?>

<p><h1><center>Add INR Dose.</h1></p>

<p align="center">Last Updated: <?php echo DATE_FORMAT($datetime1, 'd/m/Y'); ?> (<?php echo $interval->format('%a'); ?> Days Ago!)</p>
  <p align="center">Previous Week's Dosage: <?php echo $row['Total']; ?>mg</p>
  <table style="width:100%">
<form action="insert.php" method="post">
<tr>
<th><label id="first">INR</label></th>
<th><label id="first">Mon</label></th>
<th><label id="first">Tue</label></th>
<th><label id="first">Wed</label></th>
<th><label id="first">Thu</label></th>
<th><label id="first">Fri</label></th>
<th><label id="first">Sat</label></th>
<th><label id="first">Sun</label></th>
</tr>
<tr>
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
<th><input type="text" name="INR" value="<?php echo $row['INR']; ?>" size="4" style="text-align: center;"></th>
<th><input type="text" name="Mon" value="<?php echo $row['Mon']; ?>" size="4" style="text-align: right;">mg</th>
<th><input type="text" name="Tue" value="<?php echo $row['Tue']; ?>" size="4" style="text-align: right;">mg</th>
<th><input type="text" name="Wed" value="<?php echo $row['Wed']; ?>" size="4" style="text-align: right;">mg</th>
<th><input type="text" name="Thu" value="<?php echo $row['Thu']; ?>" size="4" style="text-align: right;">mg</th>
<th><input type="text" name="Fri" value="<?php echo $row['Fri']; ?>" size="4" style="text-align: right;">mg</th>
<th><input type="text" name="Sat" value="<?php echo $row['Sat']; ?>" size="4" style="text-align: right;">mg</th>
<th><input type="text" name="Sun" value="<?php echo $row['Sun']; ?>" size="4" style="text-align: right;">mg</th>
<input type="hidden" name="Days" value="<?php echo $interval->format('%a'); ?>">
</tr>
  
<?php
$q = null;
?>
</table>
<center><button type="submit" name="Insert">Insert</button><button type="submit" name="Update">Update</button></center>
</form>
  
  <hr  width="25%" align="left">
  <p>Dosage chart for INR target 2.5</p>
  <table width="25%">
    <tr>
      <td>Blood results</td>
      <td>Action</td>
      <td>Next Test</td>
    </tr>
    <tr bgcolor="red">
      <td>Over 5</td>
      <td>See doctor</td>
      <td>as advised</td>
    </tr>
    <tr bgcolor="yellow">
      <td>3.1 - 4.9</td>
      <td>Decrease dose by 1/2 mg</td>
      <td>1 week</td>
    </tr>
    <tr bgcolor="green">
      <td>2 - 3</td>
      <td>Remain on same dose</td>
      <td>2 weeks</td>
    </tr>
    <tr bgcolor="yellow">
      <td>1.6 - 1.9</td>
      <td>Increase dose by 1/2 mg</td>
      <td>1 week</td>
    </tr>
    <tr bgcolor="red">
      <td>Under 1.5</td>
      <td>See doctor</td>
      <td>as advised</td>
    </tr>
  </table>
  <hr  width="25%" align="left">
  <p>Dosage chart for INR target 3.5</p>
  <table width="25%">
    <tr>
      <td>Blood results</td>
      <td>Action</td>
      <td>Next Test</td>
    </tr>
    <tr bgcolor="red">
      <td>Over 5</td>
      <td>See doctor</td>
      <td>as advised</td>
    </tr>
    <tr bgcolor="yellow">
      <td>4.1 - 4.9</td>
      <td>Decrease dose by 1 mg</td>
      <td>1 week</td>
    </tr>
    <tr bgcolor="green">
      <td>3 - 4</td>
      <td>Remain on same dose</td>
      <td>2 weeks</td>
    </tr>
    <tr bgcolor="yellow">
      <td>1.6 - 2.9</td>
      <td>Increase dose by 1 mg</td>
      <td>1 week</td>
    </tr>
    <tr bgcolor="red">
      <td>Under 1.5</td>
      <td>See doctor</td>
      <td>as advised</td>
    </tr>
  </table>
      
  <p><a href="https://www.nice.org.uk/guidance/dg14/resources/selfmonitoring-dosage-algorithm-pdf-184803158">NICE Guidelines</a></p>
  
<p><a href="logout.php">Logout</a></p>
<?php } ?>
</body>
</html>
