<html>
<head>
<!--<meta name="twitter:widgets:autoload" content="off">-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<link href="index.css" rel="stylesheet" type="text/css">
<title>Dark Sky Home</title>
</head>

<body>
<!--	<div id="floating-panel">
	      <input type="submit" name = "hideIcons" value="hide">
	      <input type="submit" name = "showIcons" value="show">
	</div>
-->

<!--navigation menu goes at the top of every page on the site-->
<div class="menu">
<ul class="menu">
	<li><a class="active" href="index.php">Home</a></li>
	<li><a href="graphsAll.php">Graphs and Charts</a></li>
	<li><a href="weather.html">Weather</a></li>
	<li><a href="about.html">About</a></li>
</ul>
</div>

<!-- still need to make this responsive -->
<div id="map"></div>
    <script>
      function initMap() {
        <?php
        	$con = mysqli_connect("db.soic.indiana.edu", "i494f17_team45", "my+sql=i494f17_team45", "i494f17_team45");
        	if (!$con){die("Failed to connect to MySQL: " . mysqli_connect_error()); }

        	$result = "SELECT * FROM sensors;";
        	$sensors = mysqli_query($con, $result);
        	//echo var_dump($sensors);
        	while ($sensor = mysqli_fetch_assoc($sensors)) {
            $lat="SELECT latitude FROM sensors WHERE sensor_id = " . $sensor['sensor_id'] . ";";
            $lon="SELECT longitude FROM sensors WHERE sensor_id = " . $sensor['sensor_id'] . ";";
            $latResult =mysqli_query($con, $lat);
            $h = mysqli_fetch_row($latResult);
            $lonResult =mysqli_query($con, $lon);
            $v =mysqli_fetch_row($lonResult);
            $h = (string)$h[0];
            $v = (string)$v[0];
            echo "var p" . $sensor['sensor_id'] . " = {lat: " . $h . ", lng: " . $v . "};";
          }
          ?>
          var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 9,
            center: p1
          });
          <?php
          $con = mysqli_connect("db.soic.indiana.edu", "i494f17_team45", "my+sql=i494f17_team45", "i494f17_team45");
          if (!$con){die("Failed to connect to MySQL: " . mysqli_connect_error()); }

          $result = "SELECT * FROM sensors WHERE active = \"yes\";";
          $sensors = mysqli_query($con, $result);

		  if ($_SERVER['REQUEST POSTED'] = 'POST') {
			  if (isset($_POST['hideIcons'])) {
		          $sensors = NULL;
		      } else if (isset($_POST['showIcons'])){
		          $sensors = $sensors;
		      }
		  }

          while ($sensor = mysqli_fetch_assoc($sensors)) {
			$times= "SELECT * FROM sensor_data WHERE sensor_id = 'darksky_" . $sensor['sensor_id'] . "' ORDER BY time_stamp DESC LIMIT 1;";
			$sensorInfo = mysqli_query($con, $times);
			$data = mysqli_fetch_assoc($sensorInfo);
			$data = $data['readings'];
			$data = str_replace("[", "", $data);
			$data = str_replace("]", "", $data);
			$data = explode(", ", $data);
			$nightData = array_slice($data, 6,15);
			$dataAvg = round(array_sum($nightData)/count($nightData));
			$color = "red";
			if ($dataAvg <= 3) {
				 $color = "green";
			} elseif ($dataAvg <= 6) {
				$color = "yellow";
			} elseif ($dataAvg <=9) {
				$color = "orange";
			}
			if ($dataAvg <= 15){
				$color = $color . (string)$dataAvg;
			}

			$weekSQL= "SELECT * FROM sensor_data WHERE sensor_id = 'darksky_" . $sensor['sensor_id'] . "' ORDER BY time_stamp DESC LIMIT 7;";
			$sensorInfo = mysqli_query($con, $weekSQL);
			$weekData = [];
			while ($row = $sensorInfo->fetch_assoc()) {
				$row = $row['readings'];
				$row = str_replace("[", "", $row);
				$row = str_replace("]", "", $row);
				$row = explode(", ", $row);
				$rowNight = array_slice($row, 6,15);
				$weekData = array_merge($weekData, $rowNight);
			}
			$weekAvg = round(array_sum($weekData)/count($weekData));
			$weekColor = "#FF0000";
			if ($weekAvg <= 3) {
				 $weekColor = "#00FF00";
			} elseif ($weekAvg <= 6) {
				$weekColor = "#FFFF00";
			} elseif ($weekAvg <=9) {
				$weekColor = "#FFA500";
			}
			$dataEntry = "<table><tr><th>Hours Ago</th><th>Light Data</th></tr>";
			for ($x = 0; $x <=5; $x++) {
				$dataEntry .= "<tr><td>" . ($x+1) . "</td><td>" . substr($data[$x], 0, 6) . "</td></tr>";
			}
			$dataEntry .= "</table>";
            echo "var contentPoint" . $sensor['sensor_id'] . " = '<div id=\"content\">'+
                   '<div id=\"siteNotice\">'+
                   '</div>'+
                   '<h1 id=\"firstHeading\" class=\"firstHeading\">darksky_" . $sensor['sensor_id'] . "</h1>'+
                   '<div id=\"bodyContent\">'+
                   '<p>" . $dataEntry . "</p>'+
				   '<p>" . $weekAvg . "</p>'+
				   '<p> <a href=\"https://www.google.com/maps/dir//' + p" . $sensor['sensor_id'] . ".lat + ',+' + p" . $sensor['sensor_id'] . ".lng + '/@' + p" . $sensor['sensor_id'] . ".lat + ',' + p" . $sensor['sensor_id'] . ".lng + ',12z/\">Click here for directions to this sensor</a></p>' +
                   '</div>'+
                   'This links to the data for <a href=\"http://cgi.soic.indiana.edu/~team45/hnf/jump.html#Point" . $sensor['sensor_id'] . "\">Point " . $sensor['sensor_id'] . "</a>'+ '</div>' ;


               var infoPoint" . $sensor['sensor_id'] . " = new google.maps.InfoWindow({
                 content: contentPoint" . $sensor['sensor_id'] . "
               });

               var marker" . $sensor['sensor_id'] . " = new google.maps.Marker({
                 position: p" . $sensor['sensor_id'] . ",
                 map: map,
				 icon: 'img/" . $color . ".png'
               });

               marker" . $sensor['sensor_id'] . ".addListener('click', function() {
                 infoPoint" . $sensor['sensor_id'] . ".open(map, marker" . $sensor['sensor_id'] . ");
               });


			   var circle" . $sensor['sensor_id'] . " = new google.maps.Circle({
	 		   	strokeColor: '" . $weekColor . "',
	 			strokeOpacity: 0.6,
	 			strokeWeight: 1,
	 			fillColor: '" . $weekColor . "',
	 			fillOpacity: 0.25,
	 			map: map,
	 			center: p" . $sensor['sensor_id'] . ",
	 			radius: 5000
 			  });";
        	}
        	mysqli_close($con);
          ?>
      }

    </script>
	<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkh_IrwjqAOQseqdxghRYrrAIGpeTTt3M&callback=initMap">
	</script>
</div>
<span>
	<a class="twitter-timeline" data-width="220" data-height="500" href="https://twitter.com/Hoosiernf?ref_src=twsrc%5Etfw">Tweets by TwitterDev</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
</span>

<div class="download">
<a href="download.php">Download All Sensor Data</a>
</div>

</body>
</html>
