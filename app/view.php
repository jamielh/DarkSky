<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="index.css" rel="stylesheet" type="text/css">
<title>View Sensors</title>
</head>

<body>
<?php
session_start();
if(!isset($_SESSION['username'])) {
	header('location: login.html'); }
$additional_links = '<p style="font-size: 100%"><a class="main" href="manage_admin.php"> Manage Admin Access</a></p>'
?>
<!--navigation menu goes at the top of every page on the site-->
<div class="menu">
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
<center><h3>View all sensors</h3></center>
<hr style="width:15%">
<br><br>
<div class="table">
<center>
<?php
//make database connection
$con = mysqli_connect("db.soic.indiana.edu", "i494f17_team45", "my+sql=i494f17_team45", "i494f17_team45");
if (!$con)
	{die("Failed to connect to MySQL: " . mysqli_connect_error()); }

  
$sql = "SELECT sensor_id, serial, latitude, longitude, location, active FROM sensors";
$result = mysqli_query($con, $sql);
 
if ($result->num_rows > 0) {
    echo "<table><tr><th>Sensor ID</th><th>Serial Number</th><th>Latitude</th><th>Longitude</th><th>Location</th><th>Active</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
        	<td>".$row["sensor_id"]."</td>
        	<td>".$row["serial"]."</td>
			<td>".$row['latitude']."</td>
        	<td>".$row["longitude"]."</td>
        	<td>".$row["location"]."</td>
        	<td>".$row["active"]."</td>
        	</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
 
mysqli_close($con);
?>
</center>
</div>
</body>
</html>
