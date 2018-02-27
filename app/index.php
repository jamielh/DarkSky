
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
	<li><a class="active" href="index.html">Home</a></li>
	<li><a href="graphs.html">Graphs and Charts</a></li>
	<li><a href="weather.html">Weather</a></li>
	<li><a href="about.html">About</a></li>
</ul>
</div>

<!-- still need to make this responsive -->
<div id="map"></div>
    <script>
      function initMap() {
        var hnf = <?php 
            $con = mysqli_connect("db.soic.indiana.edu", "i494f17_team45", "my+sql=i494f17_team45", "i494f17_team45");

            if (!$con){die("Failed to connect to MySQL: " . mysqli_connect_error()); }
            
            $lat="SELECT latitude FROM sensors WHERE sensor_id ='1';";
            $lon="SELECT longitude FROM sensors WHERE sensor_id ='1';";
            $latResult =mysqli_query($con, $lat);
            $h = mysqli_fetch_row($latResult);

            $lonResult =mysqli_query($con, $lon);
            $v =mysqli_fetch_row($lonResult);


            $h = (string)$h[0];
            $v = (string)$v[0];

            echo "{lat: " . $h . ", lng: " . $v . "}";

             ?>;
        var hnf2 = <?php 
                    if (!$con){die("Failed to connect to MySQL: " . mysqli_connect_error()); }
            
                    $lat="SELECT latitude FROM sensors WHERE sensor_id ='2';";
                    $lon="SELECT longitude FROM sensors WHERE sensor_id ='2';";
                    $latResult =mysqli_query($con, $lat);
                    $h = mysqli_fetch_row($latResult);
        
                    $lonResult =mysqli_query($con, $lon);
                    $v =mysqli_fetch_row($lonResult);
        
        
                    $h = (string)$h[0];
                    $v = (string)$v[0];
        
                    echo "{lat: " . $h . ", lng: " . $v . "}";
        
                     ?>;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 12,
          center: hnf
        });
        var contentPoint1 = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h1 id="firstHeading" class="firstHeading">Point 1</h1>'+
            '<div id="bodyContent">'+
            '<p>If point one needs info it goes here.</p>'+
            '</div>'+
            'This links to the data for <a href="http://cgi.soic.indiana.edu/~team45/hnf/graphs.html#Point1">Point 1</a>'+ '</div>' ;

        var infoPoint1 = new google.maps.InfoWindow({
          content: contentPoint1
        });
        var contentPoint2 = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h1 id="firstHeading" class="firstHeading">Point 1</h1>'+
            '<div id="bodyContent">'+
            '<p>If point two needs info it goes here.</p>'+
            '</div>'+
            'This links to the data for <a href="http://cgi.soic.indiana.edu/~team45/hnf/graphs.html#Point2">Point 2</a>'+ '</div>' ;

        var infoPoint2 = new google.maps.InfoWindow({
          content: contentPoint2
        });
        var marker = new google.maps.Marker({
          position: hnf,
          map: map
        });
        var marker2 = new google.maps.Marker({
          position: hnf2,
          map: map
        });
        marker.addListener('click', function() {
          infoPoint1.open(map, marker);
        });
        marker2.addListener('click', function() {
          infoPoint2.open(map,marker2);
        });
      }
    </script>
	<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkh_IrwjqAOQseqdxghRYrrAIGpeTTt3M&callback=initMap">
	</script>

</body>
</html>