<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="index.css" rel="stylesheet" type="text/css">
<title>Remove Sensor</title>
</head>
<body>
<!--navigation menu goes at the top of every page on the site-->
<div class="menu">
<ul class="menu">
	<li><a href="admin.php">Admin Home</a></li>
	<li><a href="account.php">My Account</a></li>
	<li style="float:right"><a href="logout.php">Sign out</a></li>
</ul>
<?php

//make sure login is valid
session_start();
if(!isset($_SESSION['username'])) {
	header('location: login.html'); }
	
//make database connection
$con = mysqli_connect("db.soic.indiana.edu", "i494f17_team45", "my+sql=i494f17_team45", "i494f17_team45");
if (!$con)
	{die("Failed to connect to MySQL: " . mysqli_connect_error()); }
//set variables
$msg = "";
$sid = mysqli_real_escape_string($con,$_POST['sid']);
$serial = mysqli_real_escape_string($con,$_POST['serial']);

$query = "DELETE FROM sensors where sensor_id = $sid and serial = $serial;";
$result = mysqli_query($con, $query);
if ($result) {
	$msg = "That sensor has been removed. <a href='remove.php'>Remove another sensor</a>";
} else {
	$msg = "That sensor was not found in the database. Make sure the sensor ID and serial number you entered are correct. <a href='remove.php'>Try again</a>";
	}

// Close the Connection
mysqli_close($con);
 
?>

<br>
<br>
<br>
<br>
<h3><center><?php echo $msg ?></center></h3>
</body>
</html>