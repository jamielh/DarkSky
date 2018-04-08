<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="index.css" rel="stylesheet" type="text/css">
<title>Add Sensor</title>
</head>

<body>
<?php
session_start();
if(!isset($_SESSION['username'])) {
	header('location: login.html'); }
?>
<!--navigation menu goes at the top of every page on the site-->
<div class="menu">
<ul class="menu">
	<li><a class="active" href="admin.php">Admin Home</a></li>
	<li><a href="account.php">My Account</a></li>
	<li style="float:right"><a href="logout.php">Sign out</a></li>
</ul>
</div>
<br>
<br>
<br>
<br>
<center><h3>Add a sensor</h3></center>
<hr style="width:15%">
<br>
<br>
<div class="form">
<form action="NEED TO CHANGE.php" method="post">
	Sensor ID: <input type="text" name="sid" required><br><br>
	Serial Number: <input type='number' name='serial' required><br><br>
 	Latitude: <input type="text" name="latitude" required><br><br>
	Longitude: <input type="text" name="longitude" required><br><br>
	Location: <input type='text' placeholder='Description of location'required><br><br>
	Active: <select name='active'>
		<option value='yes'>Yes</option>
		<option value='no'>No</option>
		</select>
	<br><br>
	<input type="submit" value="Add Sensor"><br>
</form>
</div>




</body>
</html>