<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="index.css" rel="stylesheet" type="text/css">
<title>Remove User</title>
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
//make database connection
$con = mysqli_connect("db.soic.indiana.edu", "i494f17_team45", "my+sql=i494f17_team45", "i494f17_team45");
if (!$con)
	{die("Failed to connect to MySQL: " . mysqli_connect_error()); }
//set variables
$msg = "";
$users_to_remove = ($_POST['user_selection']);

foreach ($users_to_remove as $user) {
	$query = "DELETE FROM users WHERE user_id = '$user';";
	if (mysqli_query($con,  $query)) {
	$msg = "<span style='color: blue'>Users removed!</span><br><a href='remove_user.php'>Remove more users.</a>" ;
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
<center><h3 class="error"><?php echo $msg ;?></h3></center>



</body>
</html>