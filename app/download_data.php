<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="index.css" rel="stylesheet" type="text/css">
<title>Download Data</title>
</head>

<body>
<!--navigation menu goes at the top of every page on the site-->
<div class="menu">
<ul class="menu">
	<li><a href="index.php">Home</a></li>
	<li><a href="graphsAll.php">Graphs and Charts</a></li>
	<li><a class="active" href="weather.html">Weather</a></li>
	<li><a href="about.html">About</a></li>
</ul>
</div>
<div class="form">
<br><br><br><br>
<form action="download.php" method="POST">
<p>Select a time range to download:</p>
<br>
<label>Today<input type="radio" name="range" value="today"/></label>
<br><br>
<label>Last Week<input type="radio" name="range" value="week"/></label>
<br><br>
<label>Last Month<input type="radio" name="range" value="month"/></label>
<!--<label>Custom<input type="radio" name="range" value="custom"></label>
			 <input type="text" name="rstart" placeholder="2018-04-08 10:56:18.711640 "
<p>Enter the desired time range: <input type = "text" name="dates"></p>-->
<br><br>
<button type="submit">Download</button>
</form>
</div>






</body>
</html>