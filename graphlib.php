<?php
if (empty($_GET)) {
    $period = 6;
} else {
    $period = $_GET['period'];
}

// Start MySQL Connection
$MyHostname = "YOUR DATABASE";    // this is usually "localhost" unless your database resides on a different server
$MyUsername = "YOUR USERNAME";  // enter your username for mysql
$MyPassword = "YOUR PASSWORD";  // enter your password for mysql
$dbName     = "YOUR DB NAME";  // eter your database table name from mysql

$db = mysqli_connect("$MyHostname","$MyUsername","$MyPassword","$dbName");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

    include("phpgraphlib.php");

    $graph=new PHPGraphLib(1200,800);
    $dataArray=array();

    // Retrieve all records and display them
$sql = <<<SQL
    SELECT Date, INR
    FROM `INR`
    WHERE Date > DATE_SUB(NOW(), INTERVAL $period Month)
    ORDER BY Date ASC
SQL;

if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}

    // process every record
    while($row = $result->fetch_assoc())
    {
      $INR=$row["INR"];
      $Date=substr( $row['Date'],0,10 );
      //add to data areray
      $dataArray[$Date]=$INR;
  }

//configure graph
$graph->addData($dataArray);
$graph->setGradient("lime", "green");
$graph->setBarOutlineColor("black");
$graph->setRange(2,6);
$graph->setBars(false);
$graph->setLine(true);
$graph->setDataPoints(true);
$graph->setDataValues(true);
$graph->setGoalLine(3, "#ff0000", "dashed");
$graph->setGoalLine(4.5, "#ff0000", "dashed");
$graph->createGraph();

$db->close();
?>
