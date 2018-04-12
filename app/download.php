<?php
// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'a');

$headers = array("Timestamp", "Sensor ID", "Hour 1 Reading", "Hour 2 Reading", "Hour 3 Reading", "Hour 4 Reading" , "Hour 5 Reading" ,
			"Hour 6 Reading", "Hour 7 Reading", "Hour 8 Reading", "Hour 9 Reading", "Hour 10 Reading", "Hour 11 Reading", "Hour 12 Reading",
			"Hour 13 Reading", "Hour 14 Reading", "Hour 15 Reading","Hour 16 Reading", "Hour 17 Reading", "Hour 18 Reading", "Hour 19 Reading",
			"Hour 20 Reading", "Hour 21 Reading", "Hour 22 Reading", "Hour 23 Reading", "Hour 24 Reading") ;
// output the column headings
fputcsv($output, $headers);

//make database connection
$con = mysqli_connect("db.soic.indiana.edu", "i494f17_team45", "my+sql=i494f17_team45", "i494f17_team45");
if (!$con){die("Failed to connect to MySQL: " . mysqli_connect_error()); }
$query = "SELECT * FROM sensor_data;";
$result = mysqli_query($con, $query);
if ($result->num_rows > 0) {
//arrays for characting replacing later
$badchars = ["]", "["];
$goodchars = ["", ""];
	
while($row = $result->fetch_assoc()) {
//this can print the data with all 24 hours in one column - fputcsv($output, $row);
//build array to send to csv
$new_array = array($row["time_stamp"], $row["sensor_id"]);
//get rid of brackets
$clean_readings = str_replace($badchars, $goodchars, $row['readings']);
//create an array of all the sensor readings
$readings_list = explode(", ", $clean_readings) ;
//iterate over array of readings and add each to the end of the array that we send to csv
foreach ($readings_list as $reading) {
array_push ($new_array, $reading);}
//copy array to csv
fputcsv($output, $new_array);	
}}
?>
