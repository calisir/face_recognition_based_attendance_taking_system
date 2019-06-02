import mysql.connector
from datetime import datetime
from time import sleep

import os
import sys
import time
import paramiko
from time import gmtime, strftime

import threading

u = "root"
p = ""
h = "127.0.0.1"
d = "attendance"
prt="3307"

# Variable that controls in which intervals (per minute) to take pictures
MINUTETIME = 2
FINALMINUTE = 30


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

def detect(location, filename, course, final, cid, week):
	print("Starting detection...")
	os.system("C:/Python37/python3.exe C:/xampp/htdocs/face/videos/ok0.py -i " + location + "/" + filename + " -o " + location + " -e C:/xampp/htdocs/face/videos/models/" + course + " -f " + str(final) + " -c " + str(cid) + " -w " + str(week))


connection = mysql.connector.connect(host=h,user=u,passwd=p,db=d,port=prt)

if connection.is_connected():
	while(1):
		
		# Delay program until a multiple of 5 in time to execute only every 5 minutes
		minute = datetime.now().minute
		
		while(minute % MINUTETIME != 0):
			minute = datetime.now().minute
			print("Waiting for multiple of ", MINUTETIME, ".. Current minute: ", minute)
			sleep(5)

		final = 0
		if ((minute >= FINALMINUTE-2) and (minute <= FINALMINUTE+2)):
			final = 1
		
		# Get current day as string and current time in proper format for MySQL query
		currentDay = number_to_day(datetime.today().weekday())
		currentTime = datetime.now().strftime("%H:%M:%S")
		
		# Query to get id of current period, used as subquery in actual query
		# query = "Select id from period WHERE period.day = \'"+ currentDay +"\' AND TIME_FORMAT(\""+currentTime+"\",\"%T\") > period.start AND TIME_FORMAT(\""+currentTime+"\",\"%T\") < period.finish";

		# Return all Ip's from all camera's currently having an active class
		query = "SELECT ip, course, period.start, class.id FROM camera, class, period WHERE class.period = period.id AND camera.classroom = class.classroom AND class.period = (Select id from period WHERE period.day = \'"+ currentDay +"\' AND TIME_FORMAT(\""+currentTime+"\",\"%T\") > period.start AND TIME_FORMAT(\""+currentTime+"\",\"%T\") < period.finish);"
			
		cursor = connection.cursor()
		cursor.execute(query)
		record = cursor.fetchall()

		for row in record:
			try:
				# =============================================
				
				# Send out request to all Raspberry Pi's to take a picture
				ip = row[0]
				course = str(row[1])
				startTime = str(row[2]).replace(":", "-")
				currentDate = datetime.now().strftime("%Y-%m-%d")
				classId = row[3]
				week = datetime.now().strftime("%W")

				imageLocation = "C:\\xampp\\htdocs\\face\\snapshots\\" + currentDate + "/" + course + "/" + startTime
				print("Taking snapshot for ", ip,"...")

				c = paramiko.SSHClient()
				c.set_missing_host_key_policy(paramiko.AutoAddPolicy())
				c.connect(ip, port=22, username="pi", password="ytr")
	
				# Create directory if not exists (First Snapshot)
				print("Looking for " + imageLocation)
				if not os.path.exists(imageLocation):
					os.makedirs(imageLocation)

					# Also create attendance status for all students
					query = "SELECT student FROM enrolled WHERE course = " + course
					cur = connection.cursor()
					cur.execute(query)
					rec = cursor.fetchall()
					print("First snapshot of this class. Creating attendance in database for each student...")
					for student in rec:
						q = "INSERT INTO attendance VALUES(" + str(student[0]) +", " + str(classId) + ", " + "\"" + str(currentDate) +"\", " + "0);"
						print(q)
						cur = connection.cursor()
						cur.execute(q)
						print("Created")
					connection.commit()
					print("Done")

				# Get current time 
				fileName = datetime.now().strftime("%H-%M")
				
				# Take snapshot
				c.exec_command("raspistill -o img.jpg")

				# Wait for taking snapshot
				time.sleep(10)

				# Send the photo to local
				ftp_client=c.open_sftp()
				ftp_client.get("img.jpg", imageLocation + "\\" + fileName + ".jpg")
				ftp_client.close()

				# Start detection 				
				##########
				thread = threading.Thread(target=detect, args=(imageLocation, fileName + ".jpg", course, final, classId, week))
				thread.start()
				##########

				break
				# =============================================
			except:
				print("Error in taking a picture. Possibly not connected...")

		# Wait for a while to save memory and CPU power, less drain in infinite loop
		sleep(60)

	cursor.close()
	connection.close()