<?php
session_start(); /* Starts the session */
include('dbconnect.php');

if(!isset($_SESSION['UserData']['Username'])) {


} else {
  // Change this to 1 if you want to email someone like your doctor your INR.
$Email=0;
$Name="YOUR NAME";
$DOB="YOUR DOB";
$EmailTo="YOUR DOCTOR/FAMILY";
$EmailFrom="YOUR EMAIL ADDRESS";
  
$q = $pdo->query("SELECT * FROM INR ORDER BY id DESC LIMIT 1");
$row = $q->fetch();

    $INR = $_POST['INR'];
    $Mon = $_POST['Mon'];
    $Tue = $_POST['Tue'];
    $Wed = $_POST['Wed'];
    $Thu = $_POST['Thu'];
    $Fri = $_POST['Fri'];
    $Sat = $_POST['Sat'];
    $Sun = $_POST['Sun'];
    $Days = $_POST['Days'];
    $Total = $Mon + $Tue + $Wed + $Thu + $Fri + $Sat + $Sun;

//Connect to MySQL and instantiate our PDO object.
$pdo = new PDO("mysql:host=$host;dbname=$database", $user, $pass, $options);

//Create our INSERT SQL query.

$sql = "INSERT INTO `INR` (`INR`, `Mon`, `Tue`, `Wed`, `Thu`, `Fri`, `Sat`, `Sun`, `Days`, `Total`) VALUES (:INR, :Mon, :Tue, :Wed, :Thu, :Fri, :Sat, :Sun, :Days, :Total)";

//Prepare our statement.
$statement = $pdo->prepare($sql);

//Bind our values to our parameters.
$statement->bindValue(':INR', $INR);
$statement->bindValue(':Mon', $Mon);
$statement->bindValue(':Tue', $Tue);
$statement->bindValue(':Wed', $Wed);
$statement->bindValue(':Thu', $Thu);
$statement->bindValue(':Fri', $Fri);
$statement->bindValue(':Sat', $Sat);
$statement->bindValue(':Sun', $Sun);
$statement->bindValue(':Days', $Days);
$statement->bindValue(':Total', $Total);

//Execute the statement and insert our values.
$inserted = $statement->execute();


//Because PDOStatement::execute returns a TRUE or FALSE value,
//we can easily check to see if our insert was successful.
if($inserted){
    echo 'Row inserted!<br>';
}
  
if ($Email = 1) {
$today = date("d/m/y");  
$email_address_to = $EmailTo;
$subject = "INR Result";
$message_contents = "Name:" . $Name . "\r\nDOB: " . $DOB . "\r\nINR: " . $INR . "\r\nTaken: " . $today;
$header = "From: " . $EmailFrom . "\r\n";
mail($email_address_to,$subject,$message_contents,$header);
echo "Email Sent to:" . $email_address_to;
}

?>
<p><a href="/inr/">Back</a></p>

<?php } ?>
