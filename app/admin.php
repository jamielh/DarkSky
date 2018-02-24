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
$con = mysqli_connect("db.soic.indiana.edu", "i494f17_team45", "my+sql=i494f17_team45", "i494f17_team45");

if (!$con)
	{die("Failed to connect to MySQL: " . mysqli_connect_error()); }
//else 
//	{ echo "Established Database Connection" ;}
?>
<!--navigation menu goes at the top of every page on the site-->
<div id="menu">
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
<center><h3>Admin</h3></center>
<hr style="width:15%">
<br>
<br>
<center>
<div id="admin_options">
<p style="font-size: 100%"><a class="main" href="view.html"> View all sensors</a></p>
<hr style="height:5px; visibility:hidden;" />
<p style="font-size: 100%"><a class="main" href="add.html"> Add a sensor</a></p>
<hr style="height:5px; visibility:hidden;" />
<p p style="font-size: 100%"><a class="main" href="remove.html"> Remove a sensor</a></p>
<hr style="height:5px; visibility:hidden;" />
<p style="font-size: 100%"><a class="main" href="flash.html"> Flash a sensor</a></p>
</div>
</center>


</body>
</html>