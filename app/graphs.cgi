#! /usr/bin/env python3

print('Content-type: text/html\n')
import cgi
import MySQLdb
import hashlib
string = "i494f17_team45"                        #change username to yours!!!
password = "my+sql=i494f17_team45"	#change username to yours!!!
db_con = MySQLdb.connect(host="db.soic.indiana.edu", port = 3306, user=string, passwd=password, db=string)
cursor = db_con.cursor()

form=cgi.FieldStorage()
import smtplib

y1=str(form.getfirst('v1', 0))
y2=str(form.getfirst('v2', 0))
y3=str(form.getfirst('v3', 0))
y4=str(form.getfirst('v4', 0))
y5=str(form.getfirst('v5', 0))
y6=str(form.getfirst('v6', 0))

x1='1'
x2='2'
x3='1'
x4='2'
x5='1'
x6='2'
x7='1'
x8='2'
x9='1'
x10='2'
x11='1'
x12='2'

result="[1,"+y1+"], [2,"+y2+"], [3, "+y3+"], [4,"+y4+"], [5,"+y5+"], [6, "+y6+"]"

html1 = """<!doctype html>
	<html>
	<head>
	<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
	<script type='text/javascript'>
	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart);
	function drawChart() {
		var data = google.visualization.arrayToDataTable([
		['Time', 'Pollution'],"""
html2="""		]);
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
		<div id="curve_chart" style="width: 900px; height: 500px"></div>
		</body>
		</html>"""

#print(html.format(content=result))
#try:
print(html1+result+html2)