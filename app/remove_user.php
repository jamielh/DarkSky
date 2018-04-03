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
?>
<!--navigation menu goes at the top of every page on the site-->
<div class="menu">
<ul class="menu">
	<li><a href="admin.php">Admin Home</a></li>
	<li><a href="account.php">My Account</a></li>
	<li style="float:right"><a href="logout.php">Sign out</a></li>
</ul>
</div>
<br>
<br>
<br>
<br>
<center><h3>Remove an admin user</h3></center>
<hr style="width:15%">
<br><br>
<div class="table">
<center>
<form action = "removing_user.php" method="POST">
<?php 
//make database connection
$con = mysqli_connect("db.soic.indiana.edu", "i494f17_team45", "my+sql=i494f17_team45", "i494f17_team45");
if (!$con)
	{die("Failed to connect to MySQL: " . mysqli_connect_error()); }
$query="SELECT user_id, username, fname, lname , email FROM users WHERE username <> 'rootadmin'";
$result=mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
	echo "<table style='text-align: center'><tr><th>   </th><th>User ID</th><th>Username</th><th>First Name</th><th>Last Name</th><th>Email</th></tr>";
	while ($row = mysqli_fetch_assoc($result)) {
		echo "<tr><td><input type='checkbox' name='user_selection[]' value='" . $row["user_id"] . "'></td><td>" . $row["user_id"] . "</td><td>" . $row["username"] . "</td><td>" . $row["fname"] . "</td><td>" . $row["lname"] . "</td><td>" . $row["email"]  . "</td></tr>";
		}
	echo "</table>";
} else {
	echo "0 results";
}
mysqli_close($con);
?>
<br>
<button type="submit">Remove Selected Users</button>
</form>
</center>
</div>



</body>
</html>