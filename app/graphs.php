<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="index.css" rel="stylesheet" type="text/css">
<title>Dark Sky Home</title>
</head>

<body>
<!--navigation menu goes at the top of every page on the site-->
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
$sql="SELECT data_point, TIME(datetime) FROM data WHERE sensor_id='1' ;";


if (!$con)
	{die("Failed to connect to MySQL: " . mysqli_connect_error()); }
	
$sid = $_POST["ID"];
echo $sid."<br>";
$sid=substr($sid, -1);
echo $_POST['result'];

echo "<!doctype html>
        <html>
	<head>
	<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
        <script type='text/javascript'>";

//-----------------------Daly----------------------

echo"   google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'X');
                data.addColumn('number', 'light pollution');
                data.addRows([";

$sql="SELECT time_stamp, sensor_id, readings FROM sensor_data WHERE sensor_id='darksky_".$sid."' ORDER BY time_stamp DESC LIMIT 1;";
//$sql= "SELECT time_stamp, readings from sensor_data WHERE sensor_id='darksky_".$sid."' ORDER BY CAST(time_stamp AS DATE) DESC LIMIT 1;";
$result = $con->query($sql);
$data="";
while($row=$result->fetch_assoc())
        {$data=$data.$row['readings']."<br>";}
$sensorInfo = mysqli_query($con, $sql);
$data = str_replace("[", "", $data);
$data = str_replace("]", "", $data);
$data = explode(", ", $data);
$up=sizeof($data);
$present="";
for ($x=1; $x<=$up; $x++)
        {$present=$present."['".$x."', ".substr($data[$up-$x], 0, 6)."],";}
rtrim($present,',');
echo $present;
echo "]);

                var options = {
                        hAxis: {title: 'Hours ago', direction: '-1'},
                        vAxis: {title: 'mag/arcsec^2', viewWindow: {min: 0, max: 50}, ticks: [0, 10, 20, 30, 40, 50]}
                        };
                var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
                chart.draw(data, options);}";


//-----------------------Weekly----------------------

echo"   google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChartW);
        function drawChartW() {
                var data = new google.visualization.DataTable();
                data.addColumn('number', 'X');
                data.addColumn('number', 'light pollution');
                data.addRows([";

$sql=" SELECT time_stamp, readings from sensor_data WHERE sensor_id='darksky_".$sid."' AND time_stamp IN ( 
 SELECT max(time_stamp) from sensor_data WHERE sensor_id='darksky_".$sid."' GROUP BY CAST(time_stamp AS DATE));";
//$sql= "SELECT time_stamp, readings from sensor_data WHERE sensor_id='darksky_".$sid."' GROUP BY CAST(time_stamp AS DATE) ORDER BY CAST(time_stamp AS DATE) ASC;";

//$sql= "SELECT MAX(time_stamp), readings from sensor_data WHERE sensor_id='darksky_".$sid."' GROUP BY time_stamp DESC;";
//$sql= "SELECT * FROM sensor_data WHERE sensor_id = 'darksky_" . $sid . "' ORDER BY time_stamp DESC LIMIT 7";

$result = $con->query($sql);
$data="";
while($row=$result->fetch_assoc())
        {$data=$data.$row['readings']."<br>";}
$sensorInfo = mysqli_query($con, $sql);
$data = str_replace("[", "", $data);
$data = str_replace("]", "", $data);
$data = explode(", ", $data);
$up=sizeof($data);
$present="";
for ($x=1; $x<=$up; $x++)
        {$present=$present."[".$x*0.042.", ".substr($data[$up-$x], 0, 6)."],";}
rtrim($present,',');
echo $present;
echo "]);

                var options = {
			hAxis: {title: 'Days ago', direction: '-1', viewWindow: {min: 0, max: 7},ticks: [0,1,2,3,4,5,6,7]},
                        vAxis: {title: 'mag/arcsec^2', viewWindow: {min: 0, max: 50}, ticks: [0, 10, 20, 30, 40, 50]}
                        };
                var chart = new google.visualization.LineChart(document.getElementById('curve_chartW'));
                chart.draw(data, options);}";

//-----------------------Monthly----------------------
echo"   google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChartM);
        function drawChartM() {
                var data = new google.visualization.DataTable();
                data.addColumn('number', 'X');
                data.addColumn('number', 'light pollution');
                data.addRows([";

//$sql= "SELECT MAX(time_stamp), readings from sensor_data WHERE sensor_id='darksky_".$sid."' GROUP BY CAST(time_stamp AS DATE) DESC;";
$sql = " SELECT time_stamp, readings from sensor_data WHERE sensor_id='darksky_".$sid."' AND time_stamp IN ( 
 SELECT max(time_stamp) from sensor_data WHERE sensor_id='darksky_".$sid."' GROUP BY CAST(time_stamp AS DATE));";

$result = $con->query($sql);
$data="";
$avg="";
$avgArray = array();
while($row=$result->fetch_assoc())
        {$data=$data.$row['readings']."<br>";
	$row['readings'] = str_replace("[", "", $row['readings']);
	$row['readings'] = str_replace("]", "", $row['readings']);
	$row['readings'] = explode(", ", $row['readings']);
	$avg=$avg.substr(array_sum($row['readings'])/sizeof($row['readings']), 0, 6);
	array_push($avgArray, substr(array_sum($row['readings'])/sizeof($row['readings']), 0, 6));
	}
$up=sizeof($avgArray);
$present="";
for ($x=1; $x<=$up; $x++)
        {$present=$present."[".$x.", ".substr($avgArray[$up-$x], 0, 6)."],";}
rtrim($present,',');
echo $present;
echo "]);

                var options = {
                        hAxis: {title: 'Days ago', direction: '-1', viewWindow: {min: 1, max: 30}},
                        vAxis: {title: 'mag/arcsec^2', viewWindow: {min: 0, max: 50}, ticks: [0, 10, 20, 30, 40, 50]}
                        };
                var chart = new google.visualization.LineChart(document.getElementById('curve_chartM'));
                chart.draw(data, options);}";

echo "
                </script>
                </head>
                <body>    <h3>Daily</h3> <div id='curve_chart' style='width: 100%; height: 500px'></div><br><br>
                <h3>Weekly</h3><div id='curve_chartW' style='width: 100%; height: 500px'></div><br><br>
		<h3>Monthly</h3><div id='curve_chartM' style='width: 100%; height: 500px'></div>
		</center>";
echo "		</body>
                </html>";
                
mysqli_close($con);
mysqli_free_result($result);
?>