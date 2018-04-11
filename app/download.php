<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="index.css" rel="stylesheet" type="text/css">
<title>Download Data</title>
</head>

<body>
<?php
//make database connection
$con = mysqli_connect("db.soic.indiana.edu", "i494f17_team45", "my+sql=i494f17_team45", "i494f17_team45");
if (!$con){die("Failed to connect to MySQL: " . mysqli_connect_error()); }
$result = "SELECT * FROM sensors;";
$sensors = mysqli_query($con, $result);
while ($sensor = mysqli_fetch_assoc($sensors)) {
	$times= "SELECT MAX(time_stamp), readings FROM sensor_data WHERE sensor_id = 'darksky_" . $sensor['sensor_id'] . "';";
	$sensorInfo = mysqli_query($con, $times);
	$data = mysqli_fetch_assoc($sensorInfo);
	$data = $data['readings'];
	$data = str_replace("[", "", $data);
	$data = str_replace("]", "", $data);
	$data = explode(", ", $data);
	echo $data
<!--navigation menu goes at the top of every page on the site-->
<div class="menu">
<ul class="menu">
	<li><a href="index.php">Home</a></li>
	<li><a href="graphsAll.php">Graphs and Charts</a></li>
	<li><a class="active" href="weather.html">Weather</a></li>
	<li><a href="about.html">About</a></li>
</ul>
</div>



</body>
</html>