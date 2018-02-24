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
$con = mysqli_connect("db.soic.indiana.edu", "i494f17_team45", "my+sql=i494f17_team45", "i494f17_team45");

if (!$con)
	{die("Failed to connect to MySQL: " . mysqli_connect_error()); }

if(!isset($_SESSION['username'])) {
	header('location: login.html'); }
$pass_msg = "";
//make database connection
$con = mysqli_connect("db.soic.indiana.edu", "i494f17_team45", "my+sql=i494f17_team45", "i494f17_team45");
if (!$con)
	{die("Failed to connect to MySQL: " . mysqli_connect_error()); }

//set variables
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$password = test_input(($_POST['pass']));
	$conf_password = test_input(($_POST['conf_pass']));
}
//scrub data	
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($password != $conf_password) {
	$pass_msg = "Passwords do not match."; }
//store password and confirm to user
 else {
	$password = password_hash($password, PASSWORD_DEFAULT);
	$uname = $_SESSION['username'];
	$query="UPDATE users SET password = '$password' WHERE username='$uname';";
	if (mysqli_query($con, $query)){
	$pass_msg = "<span style='color: blue'>Password changed! Return to <a href='login.html'>sign in</a>. </span>"  ;}
	else {die('SQL Error: ' . mysqli_connect_error());}}
	mysqli_close($con);	
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
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
<p>New Password: <input type = "password" name="pass" required> </p>
<p>Confirm New Password: <input type = "password" name="conf_pass" required></p>
<br>
<button type="submit">Change Password</button>
<p class="error"><?php echo $pass_msg;?>
</form>
</div>

</body>
</html>