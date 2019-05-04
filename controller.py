import mysql.connector
from datetime import datetime
from time import sleep


u = "root"
p = "123456asm"
h = "localhost"
d = "attendance"


def number_to_day(arg):
	switcher = { 
		0: "Monday", 
		1: "Tuesday", 
		2: "Wednesday", 
		3: "Thursday", 
		4: "Friday", 
		5: "Saturday",
		6: "Sunday"
	} 
	return switcher.get(arg, "Invalid day")

connection = mysql.connector.connect(host=h,database=d,user=u,password=p)

if connection.is_connected():
	while(1):
		
		# Delay program until a multiple of 5 in time to execute only every 5 minutes
		minute = datetime.now().minute
		
		while(minute % 5 != 0):
			minute = datetime.now().minute
			sleep(5)
		
		# Get current day as string and current time in proper format for MySQL query
		currentDay = number_to_day(datetime.today().weekday())
		currentTime = datetime.now().strftime("%H:%M:%S")
		
		# Query to get id of current period, used as subquery in actual query
		# query = "Select id from period WHERE period.day = \'"+ currentDay +"\' AND TIME_FORMAT(\""+currentTime+"\",\"%T\") > period.start AND TIME_FORMAT(\""+currentTime+"\",\"%T\") < period.finish";

		# Return all Ip's from all camera's currently having an active class
		query = "SELECT ip FROM camera, class WHERE camera.classroom = class.classroom AND class.period = (Select id from period WHERE period.day = \'"+ currentDay +"\' AND TIME_FORMAT(\""+currentTime+"\",\"%T\") > period.start AND TIME_FORMAT(\""+currentTime+"\",\"%T\") < period.finish)";
			
		cursor = connection.cursor()
		cursor.execute(query)
		record = cursor.fetchall()

		for row in record:
			
			# =============================================
			# Send out request to all Raspberry Pi's to take a picture
			print (row)
			# =============================================

		# Wait for 4 and a half minutes to save memory and CPU power, less drain in infinite loop
		sleep(270)

	cursor.close()
	connection.close();
