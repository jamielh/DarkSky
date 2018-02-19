<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="index.css" rel="stylesheet" type="text/css">
<title>Add User</title>
</head>
<body>
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
	<li><a href="admin.php">Admin Home</a></li>
	<li><a href="account.php">My Account</a></li>
	<li style="float:right"><a href="logout.php">Sign out</a></li>
</ul>
<br>
<br>
<br>
<br>
<center><h3>Add an admin user</h3></center>
<hr style="width:15%">
<br>
<br>
<div class="form">
<br><br><br><br>
<form action="adding_user.php" method="POST">
<p>First Name: <input type = "text" name="first" required></p>
<p>Last Name: <input type = "text" name="last" required></p>
<p>Email: <input type = "text" name="email" required></p>
<p>Username: <input type = "text" name="user" required> </p>
<br>
<button type="submit">Add User</button>
</form>
</div>
</body>
</html>