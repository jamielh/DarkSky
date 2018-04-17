<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="index.css" rel="stylesheet" type="text/css">
<title>Dark Sky Home</title>
</head>

<body>
<div class="menu">
<ul class="menu">
        <li><a href="index.php">Home</a></li>
        <li><a class="active" href="graphsAll.php">Graphs and Charts</a></li>
        <li><a href="weather.html">Weather</a></li>
        <li><a href="about.html">About</a></li>
</ul>
</div>
<center>
<?php
$con=mysqli_connect("db.soic.indiana.edu", "i494f17_team45", "my+sql=i494f17_team45", "i494f17_team45");
$sql="SELECT sensor_id  FROM sensor_data GROUP BY sensor_id;";
$result = $con->query($sql);
$limit = 0;
while($row=$result->fetch_assoc())
	{$limit +=1;}
echo "<h2>All Sensors</h2>";
echo $limit." sensors detected<br>";
if (!$con)
	{die("Failed to connect to MySQL: " . mysqli_connect_error()); }

echo "<!doctype html>
        <html>
	<head>
	<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
	<script type='text/javascript'>
        google.charts.load('current', {'packages':['corechart']});";

for ($i=0; $i<$limit;$i++)
        {
//	$sql="SELECT * FROM sensor_data WHERE sensor_id = 'darksky_" . $i . "' ORDER BY time_stamp DESC LIMIT 1;";
	$sql="SELECT time_stamp, sensor_id, readings FROM sensor_data WHERE sensor_id='darksky_".$i."' ORDER BY time_stamp DESC LIMIT 1;"; 
       $result = $con->query($sql);
		$data="";
		while($row=$result->fetch_assoc())
		        {$data=$data.$row['readings']."<br>";}
		$sensorInfo = mysqli_query($con, $sql);
		$data = str_replace("[", "", $data);
		$data = str_replace("]", "", $data);
		$data = explode(", ", $data);
		$up=13;
		$present="";
		echo "

		google.charts.setOnLoadCallback(drawChart".$i.");
        function drawChart".$i."() {
                var data = new google.visualization.DataTable();
		data.addColumn('string', 'X');
		data.addColumn('number', 'light pollution');
		data.addRows([";

		for ($x=1; $x<=24; $x++)
		{$present=$present."['".$x."', ".substr($data[24-$x], 0, 6)."],";}
		rtrim($present,',');
		echo $present;

		echo "]);
            var options = {
			hAxis: {title: 'Hours ago', direction: '-1'},
			vAxis: {title: 'mag/arcsec^2', viewWindow: {min: 0, max: 50}, ticks: [0, 10, 20, 30, 40, 50]}};
            var chart = new google.visualization.LineChart(document.getElementById('curve_chart".$i."'));
	    chart.draw(data, options);}";}
echo "		</script>
                </head>
                <body>";
                for ($i=0; $i<$limit;$i++)
                {echo "<h2>Sensor".$i."</h2>";
		echo "<div id='curve_chart".$i."' style='width: 100%; height: 500px'> <h2>sensor".$i."</h2></div>";}
echo         "</center></body>
                </html>";

?>