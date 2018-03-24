<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="index.css" rel="stylesheet" type="text/css">
<title>Add Sensor</title>
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
$latitude = mysqli_real_escape_string($con,$_POST['latitude']);
$longitude = mysqli_real_escape_string($con,$_POST['longitude']);
$location = mysqli_real_escape_string($con,$_POST['location']);
$active = mysqli_real_escape_string($con,$_POST['active']);


//scrub data	
//function test_input($data) {
  //$data = trim($data);
//  $data = stripslashes($data);
//  $data = htmlspecialchars($data);
//  return $data;
//}
//if username not already in database, insert user into the database
//$query="SELECT sensor_id FROM sensors WHERE sensor_id='$sid';";
//$result=mysqli_query($con, $query);
//if (mysqli_num_rows($result) > 0) {
//	$msg = "Sensor already exists. <a href='add.php'>Try again</a>";
//} else {
//	$query="INSERT INTO sensor (sensor_id, serial, latitude, longitude, location, active) VALUES ('$sid', '$serial', '$latitude', '$longitude', '$location', '$active')";
//	if (mysqli_query($con,  $query)) {
	//$msg = "<span style='color: blue'>Sensor added!</span><br><a href='add.php'>Add another sensor.</a>" ;
$query = "SELECT sensor_id FROM sensors WHERE sensor_id = $sid;";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
	$msg = "That sensor already exists. <a href='add.php'>Try again</a>";
} else {
	$sql = "INSERT INTO sensors (sensor_id, serial, latitude, longitude, location, active) VALUES ($sid, $serial, $latitude, $longitude, '$location', '$active')";
	}
	if (mysqli_query($con,$sql)) {
		$msg = "<span style='color: blue'>Sensor added!</span><br><a href='add.php'>Add another sensor.</a>";
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