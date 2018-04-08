import paho.mqtt.client as mqtt
import time
import binascii
import json
import MySQLdb
import cgi

string = "i494f17_team45"
password = "my+sql=i494f17_team45"

db_con = MySQLdb.connect(host="db.soic.indiana.edu", port = 3306, user=string, passwd=password, db=string)
cursor = db_con.cursor()

def on_message(client, userdata, message):
    #print("Message Received:", message.payload)
	#changes bytes into a string
	b_to_s = message.payload.decode(encoding='UTF-8')
	#puts into json format so data can be used as dictionary
	json_Dict = json.loads(b_to_s)
	#stores data in variables
	timestamp = json_Dict['Timestamp']
	sensor_id = json_Dict["Sensor ID"]
	readings =	json_Dict["Hourly Light Samples"]
	#print(timestamp, sensor_id, readings)
	#insert into database code goes here!!!
	try:
		sql = 'INSERT INTO sensor_data(time_stamp, sensor_id, readings)'
		sql+= 'VALUES("' + str(timestamp) + '", "' + str(sensor_id) + '", "' + str(readings) + '");'
		cursor.execute(sql)
		db_con.commit()
    
	except Exception as e:
		print('<p>Something went wrong with the SQL!</p>')
		print(sql, "Error:", e)
	
    
broker_address = "pivot.iuiot.org" 
client = mqtt.Client()
client.on_message=on_message
client.connect(broker_address)
client.loop_start()

# Subscribe to all light sensor data
client.subscribe("sensors/light/+")
time.sleep(60)
#time.sleep(5)
client.loop_stop()