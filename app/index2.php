
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
	<li><a class="active" href="index.php">Home</a></li>
	<li><a href="graphs.html">Graphs and Charts</a></li>
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

          $result = "SELECT * FROM sensors;";
          $sensors = mysqli_query($con, $result);
          while ($sensor = mysqli_fetch_assoc($sensors)) {
            echo "var contentPoint" . $sensor['sensor_id'] . " = '<div id=\"content\">'+
                   '<div id=\"siteNotice\">'+
                   '</div>'+
                   '<h1 id=\"firstHeading\" class=\"firstHeading\">Point " . $sensor['sensor_id'] . "</h1>'+
                   '<div id=\"bodyContent\">'+
                   '<p>If point " . $sensor['sensor_id'] . " needs info it goes here.</p>'+
				   '<p> <a href=\"https://www.google.com/maps/dir//' + p" . $sensor['sensor_id'] . ".lat + ',+' + p" . $sensor['sensor_id'] . ".lng + '/@' + p" . $sensor['sensor_id'] . ".lat + ',' + p" . $sensor['sensor_id'] . ".lng + ',12z/\">Click here for directions </a></p>' +
                   '</div>'+
                   'This links to the data for <a href=\"http://cgi.soic.indiana.edu/~team45/hnf/jump.html#Point" . $sensor['sensor_id'] . "\">Point " . $sensor['sensor_id'] . "</a>'+ '</div>' ;

               var infoPoint" . $sensor['sensor_id'] . " = new google.maps.InfoWindow({
                 content: contentPoint" . $sensor['sensor_id'] . "
               });



			   var circle" . $sensor['sensor_id'] . " = new google.maps.Circle({

  				strokeColor:'#FF0000',
  				strokeOpacity:0.8,
  				strokeWeight:2,
  				fillColor:'#FF0000',
  				fillOpacity:0.4,
				map: map,
				center:p" . $sensor['sensor_id'] . ",
				radius:5000,
				clickable: true
			});

			circle" . $sensor['sensor_id'] . ".addListener('click', function() {
			  infoPoint" . $sensor['sensor_id'] . ".open(map, circle" . $sensor['sensor_id'] . ");
			});";
        	}
        	mysqli_close($con);
          ?>
      }
    </script>
	<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkh_IrwjqAOQseqdxghRYrrAIGpeTTt3M&callback=initMap">
	</script>
<div>
	<a class="twitter-timeline" data-width="220" data-height="500" href="https://twitter.com/Hoosiernf?ref_src=twsrc%5Etfw">Tweets by TwitterDev</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
</div>

</div>
</body>
</html>
