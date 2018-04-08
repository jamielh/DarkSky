
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
<div id="map" class="gmap"></div>
    <script>
	var myLatLng;
	var latit;
	var longit;
      function geoSuccess(position) {
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

		  var latitude = position.coords.latitude;
		  var longitude = position.coords.longitude;

		  //Directions INIT
		  var directionsService = new google.maps.DirectionsService;
		  var directionsDisplay = new google.maps.DirectionsRenderer;

		  myLatLng = {
			  lat: latitude,
			  lng: longitude
		  };

		  //makes the map
          var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 9,
            center: p1
          });

		  directionsDisplay.setMap(map);
		  var bounds = new google.maps.LatLngBounds();

		  //I want to make my location a marker on the map
		  var me = new google.maps.Marker({
			  position: myLatLng,
			  map: map,
			  title: 'My location'
		  });

		  //This PHP is used to get the locations from the database and displaay them
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
                   '</div>'+
                   'This links to the data for <a href=\"http://cgi.soic.indiana.edu/~team45/hnf/graphs.html#Point" . $sensor['sensor_id'] . "\">Point " . $sensor['sensor_id'] . "</a>'+ '</div>' ;

               var infoPoint" . $sensor['sensor_id'] . " = new google.maps.InfoWindow({
                 content: contentPoint" . $sensor['sensor_id'] . "
               });

               var marker" . $sensor['sensor_id'] . " = new google.maps.Marker({
                 position: p" . $sensor['sensor_id'] . ",
                 map: map
               });

               marker" . $sensor['sensor_id'] . ".addListener('click', function() {
                 infoPoint" . $sensor['sensor_id'] . ".open(map, marker" . $sensor['sensor_id'] . ");

//new stuff here oh lord

				 directionsService.route({
					 // origin: document.getElementById('start').value,
					 origin: myLatLng,

					 // destination: marker.getPosition(),
					 destination: p" . $sensor['sensor_id'] . ",
					 travelMode: 'WALKING'
				 }, function(response, status) {
					 if (status === 'OK') {
						 directionsDisplay.setDirections(response);
					 } else {
						 window.alert('Directions request failed due to ' + status);
					 }
				 });

//new stuff ends send help

               });";
        	}
        	mysqli_close($con);
          ?>

      }

	  function geoError() {
		  alert("Geocoder failed.");
	  }

	  function getLocation() {
		  if (navigator.geolocation) {
			  navigator.geolocation.getCurrentPosition(geoSuccess, geoError);
			  // alert("Geolocation is supported by this browser.");
		  } else {
			  alert("Geolocation is not supported by this browser.");
		  }
	  }
    </script>
	<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkh_IrwjqAOQseqdxghRYrrAIGpeTTt3M&callback=getLocation">
	</script>
<div>
	<a class="twitter-timeline" data-width="220" data-height="500" href="https://twitter.com/Hoosiernf?ref_src=twsrc%5Etfw">Tweets by TwitterDev</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
</div>

</div>
</body>
</html>
