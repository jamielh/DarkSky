<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="index.css" rel="stylesheet" type="text/css">
<title>Change Password</title>
</head>
<body>
<?php
//make sure login is valid
session_start();
if(!isset($_SESSION['username'])) {
	header('location: login.html'); }
	
//make database connection
$con = mysqli_connect("db.soic.indiana.edu", "i494f17_team45", "my+sql=i494f17_team45", "i494f17_team45");
if (!$con)
	{die("Failed to connect to MySQL: " . mysqli_connect_error()); }

//set variables
$password = test_input(($_POST['pass']));
$conf_password = test_input(($_POST['conf_pass']));

//scrub data	
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($password != $conf_password) {
	$msg = "Passwords do not match. <a href='password.php'>Try again.</a>"; }
//store password and confirm to user
 else {
	$password = password_hash($password, PASSWORD_DEFAULT);
	$uname = $_SESSION['username'];
	$query="UPDATE users SET password = '$password' WHERE username='$uname';";
	if (mysqli_query($con, $query)){
	$msg = "<span style='color: blue'>Password changed! Return to <a href='login.html'>sign in</a>. </span>" ;
	session_destroy();
	}
	else {die('SQL Error: ' . mysqli_connect_error());}}
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
<center><h3 class="error"><?php echo $msg;?></h3></center>
</body>
</html>