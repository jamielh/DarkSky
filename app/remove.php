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
<center><h3>Remove a sensor</h3></center>
<hr style="width:15%">
<br>
<br>
<div class="form">
<br><br><br><br>
<form action="remove_sensor.php" method="post">
	<p>Sensor ID: <input type="text" name="sid" required></p>
	<p>Serial Number: <input type='number' name='serial' required></p>
 	<br>
	<button type="submit">Remove Sensor</button>
</form>
</div>


</body>
</html>