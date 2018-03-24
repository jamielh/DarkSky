<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="index.css" rel="stylesheet" type="text/css">
<title>Remove Sensor</title>
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
<center><h3>Remove A Sensor</h3>



<form action="remove_sensor.php" method="post">
	Sensor ID: <input type="text" name="sid" required><br><br>
	Serial Number: <input type='number' name='serial' required><br><br>
 	<br><br>
	<input type="submit" value="Remove Sensor"><br>
</form>


</center>

</body>
</html>