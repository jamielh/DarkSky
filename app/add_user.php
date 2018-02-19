<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="index.css" rel="stylesheet" type="text/css">
<title>Add User</title>
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
//make database connection
$con = mysqli_connect("db.soic.indiana.edu", "i494f17_team45", "my+sql=i494f17_team45", "i494f17_team45");
if (!$con)
	{die("Failed to connect to MySQL: " . mysqli_connect_error()); }
//set variables
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$fname = test_input(($_POST['first']));
	$lname = test_input(($_POST['last']));
	$email = test_input(($_POST['email']));
	$username = test_input(($_POST['user']));
}
$password = $username . "_test";
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
	$error = "User already exists.";
} else {
	$query="INSERT INTO users (username, password, fname, lname, email) VALUES ('$username', '$hashed_password', '$fname', '$lname', '$email')";
	if (mysqli_query($con,  $query)) {
	$error = "<span style='color: blue'>User added! They will receive an email containing their password shortly.</span>" ; }}	
?>

<body>
<!--navigation menu goes at the top of every page on the site-->
<div class="menu">
<ul class="menu">
	<li><a class="active" href="admin.php">Admin Home</a></li>
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
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
<p>First Name: <input type = "text" name="first" required></p>
<p>Last Name: <input type = "text" name="last" required></p>
<p>Email: <input type = "text" name="email" required></p>
<p>Username: <input type = "text" name="user" required> </p>
<br>
<button type="submit">Add User</button>
<p class="error"><?php echo $error?>
</form>
</div>
</body>
</html>

