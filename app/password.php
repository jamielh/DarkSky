<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="index.css" rel="stylesheet" type="text/css">
<title>Change Password</title>
</head>
<?php
//make sure login is valid
session_start();
if(!isset($_SESSION['username'])) {
	header('location: login.html'); }
?>

<!--navigation menu goes at the top of every page on the site-->
<div class="menu">
<ul class="menu">
	<li><a href="admin.php">Admin Home</a></li>
	<li><a class="active" href="account.php">My Account</a></li>
	<li style="float:right"><a href="logout.php">Sign out</a></li>
</ul>
</div>
<br>
<br>
<br>
<br>
<center><h3>Change Password</h3></center>
<hr style="width:15%">
<br>
<br>
<div class="form">
<br><br><br><br>
<form action="change_password.php" method="post">
<p>New Password: <input type = "password" name="pass" required> </p>
<p>Confirm New Password: <input type = "password" name="conf_pass" required></p>
<br>
<button type="submit">Change Password</button>
</form>
</div>

</body>
</html>