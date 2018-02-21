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
?>
<!--navigation menu goes at the top of every page on the site-->
<div class="menu">
<ul class="menu">
	<li><a  href="admin.php">Admin Home</a></li>
	<li><a class="active" href="account.php">My Account</a></li>
	<li style="float:right"><a href="logout.php">Sign out</a></li>
</ul>
</div>
<div class="greeting">
<p id="greeting">Hello, <?php echo $_SESSION['username'] ?> </p>
</div>
<hr style="height:5px; visibility:hidden;" />
<center><p style="font-size: 100%"><a class="main" href="password.php"> Change your password</a></p></center>





</body>
</html>

























