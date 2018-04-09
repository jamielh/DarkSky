<?php
$con=mysqli_connect("db.soic.indiana.edu", "i494f17_team45", "my+sql=i494f17_team45", "i494f17_team45");
$sql="SELECT data_point, TIME(datetime) FROM data WHERE sensor_id='1' ;";
$limit=2;

if (!$con)
	{die("Failed to connect to MySQL: " . mysqli_connect_error()); }
else 
	{ echo "Established Database Connection <br>" ;}

echo "<!doctype html>
        <html>
	<head>
	<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
	<script type='text/javascript'>
        google.charts.load('current', {'packages':['corechart']});";
$part1= "<script type='text/javascript'>
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
                var data = google.visualization.arrayToDataTable([['Time', 'Pollution']";

for ($i=1; $i<=$limit;$i++)
        {
	$sql="SELECT data_point, TIME(datetime) FROM data WHERE sensor_id='".$i."';";
        $result = $con->query($sql);
        if ($result->num_rows > 0)
                {
		echo "google.charts.setOnLoadCallback(drawChart".$i.");
        function drawChart".$i."() {
                var data = google.visualization.arrayToDataTable([['Time', 'Pollution']";
                while($row=$result->fetch_assoc())
                        {echo ", ['".$row["TIME(datetime)"]. "', ".$row["data_point"]."]";}
                echo "]);
                var options = {
                        title: 'Light pollution',
                        curveType: 'function',
                        legend: { position: 'bottom' }
                        };
                var chart = new google.visualization.LineChart(document.getElementById('curve_chart".$i."'));
                chart.draw(data, options);}";
		}
        else
            	{echo "0 results";}}
echo "		</script>
                </head>
                <body>";
                for ($i=1; $i<=$limit;$i++)
                {echo "<h2>Sensor".$i."</h2>";
		echo "<div id='curve_chart".$i."' style='width: 900px; height: 500px'> <h2>sensor".$i."</h2></div>";}
echo         "</body>
                </html>";
//echo $part1.$part2.$part3;

?>