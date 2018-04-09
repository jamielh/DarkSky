<?php
$con=mysqli_connect("db.soic.indiana.edu", "i494f17_team45", "my+sql=i494f17_team45", "i494f17_team45");
$sql="SELECT data_point, TIME(datetime) FROM data WHERE sensor_id='1' ;";


if (!$con)
	{die("Failed to connect to MySQL: " . mysqli_connect_error()); }
else 
	{ echo "Established Database Connection <br>" ;}
	
$sid = $_POST["ID"];
echo $sid."<br>";
$sid=substr($sid, -1);
$sql="SELECT data_point, TIME(datetime) FROM data WHERE sensor_id='".$sid."' ;";

echo $_POST['result'];

echo "<!doctype html>
        <html>
	<head>
	<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
        <script type='text/javascript'>
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
                var data = google.visualization.arrayToDataTable([['Time', 'Pollution']";

$result = $con->query($sql);
if ($result->num_rows > 0)
        {
        while($row=$result->fetch_assoc())
                {echo  ", ['".$row["TIME(datetime)"]. "', ".$row["data_point"]."]";}
        }
else
    	{echo "0 results";}
mysqli_close($con);
mysqli_free_result($result);

//echo ",[1,1 ], [2, 2], [3, 3], [4, 4], [5, 5], [6, 6]";
echo "]);

                var options = {
                        title: 'Company Performance',
                        curveType: 'function',
                        legend: { position: 'bottom' }
                        };
                var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
                chart.draw(data, options);}
                </script>
                </head>
                <body>
                <div id='curve_chart' style='width: 900px; height: 500px'></div>
                </body>
                </html>";
//echo $part1.$part2.$part3;

?>
