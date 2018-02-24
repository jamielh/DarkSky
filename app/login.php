<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="index.css" rel="stylesheet" type="text/css">
<title>Sign In</title>
</head>

<body>

<?php
session_start();

if (isset($_POST['uname']) and isset($_POST['pass']))
//pull data from form
$username = test_input(($_POST['uname']));
$password = test_input(($_POST['pass']));

//makes sure data is safe
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
 

$con = mysqli_connect("db.soic.indiana.edu", "i494f17_team45", "my+sql=i494f17_team45", "i494f17_team45");

if (!$con)
	{die("Failed to connect to MySQL: " . mysqli_connect_error()); }
//else 
//	{ echo "Established Database Connection" ;}

$query="SELECT password FROM users WHERE username='$username';";
$result=mysqli_query($con, $query);
$row=mysqli_fetch_assoc($result);
$db_password=$row['password'];
if (password_verify($password, $db_password)) {
	$_SESSION['username'] = $username;
	header('Location: admin.php');
} else {
    echo "<center><h3 style='font-family: 'Helvetica', 'Arial', sans-serif'>Invalid login,<br><a href='login.html'>try again.</a></h3></center>";}
mysqli_close($con); 
?>


</body>
</html>
