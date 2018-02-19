<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="index.css" rel="stylesheet" type="text/css">
<title>Manage Admin Access</title>
</head>

<?php
//make sure login is valid
session_start();
if(!isset($_SESSION['username'])) {
	header('location: login.html'); }
	else {
	if ($_SESSION['username'] != 'rootadmin') {
		header('location: access_error.html');
	}}
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
<center><h3>Manage Admin Access</h3></center>
<hr style="width:15%">
<br>
<br>
<center>
<div class="admin_options">
<p style="font-size: 100%"><a class="main" href="add_user.php">Add an admin user</a></p>
<hr style="height:5px; visibility:hidden;" />
<p style="font-size: 100%"><a class="main" href="remove_user.php">Remove an admin user</a></p>
</div>
</center>


</body>
</html>