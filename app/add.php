<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="index.css" rel="stylesheet" type="text/css">
<title>Admin Home</title>
</head>

<body>
<?php
session_start();
if(!isset($_SESSION['username'])) {
	header('location: login.html'); }
$additional_links = '<p style="font-size: 100%"><a class="main" href="manage_admin.php"> Manage Admin Access</a></p>'
?>
<!--navigation menu goes at the top of every page on the site-->
<div class="menu">
<ul class="menu">
	<li><a class="active" href="admin.php">Admin Home</a></li>
	<li><a href="account.php">My Account</a></li>
	<li style="float:right"><a href="logout.php">Sign out</a></li>
</ul>
</div>
<h3>Add A Sensor</h3>



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




</body>
</html>