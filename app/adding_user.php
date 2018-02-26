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
//make database connection
$con = mysqli_connect("db.soic.indiana.edu", "i494f17_team45", "my+sql=i494f17_team45", "i494f17_team45");
if (!$con)
	{die("Failed to connect to MySQL: " . mysqli_connect_error()); }
//set variables
$msg = "";
$fname = test_input(($_POST['first']));
$lname = test_input(($_POST['last']));
$email = test_input(($_POST['email']));
$username = test_input(($_POST['user']));
$password = $username . "_temp";
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

//scrub data	
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
//if username not already in database, insert user into the database
$query="SELECT username FROM users WHERE username='$username';";
$result=mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
	$msg = "User already exists. <a href='add_user.php'>Try again</a>";
} else {
	$query="INSERT INTO users (username, password, fname, lname, email) VALUES ('$username', '$hashed_password', '$fname', '$lname', '$email')";
	if (mysqli_query($con,  $query)) {
	$msg = "<span style='color: blue'>User added! They will receive an email containing their password shortly.</span><br><a href='add_user.php'>Add another user.</a>" ;

	$to = $email;
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
	$subject = "Your Hoosier National Forest Dark Sky Admin Account";
	$message = "
	<html>
	<head>
	<title>HTML email</title>
	</head>
	<body>
	<p>An admin account for the Hoosier National Forest Dark Sky project has been created for you. </p>
	<p>Your username: $username </p>
	<p>Your password: $password </p>
	<p>Please sign in to <a href='cgi.soic.indiana.edu/~team45/hnf/admin.html'>cgi.soic.indiana.edu/~team45/hnf/admin.html</a> and select My Account > Change Password to secure your account.</p>
	</body>
	</html>
	";}}

mail($to, $subject, $message, $headers);

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

