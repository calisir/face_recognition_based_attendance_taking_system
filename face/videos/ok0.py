# python OK0_identify.py -i samples/4.png -e model/eleven
#  Windows: 

import mysql.connector
import os
import argparse
import shutil
from collections import Counter


ap = argparse.ArgumentParser()
ap.add_argument("-i", "--image", required=True)
ap.add_argument("-o", "--output", required=True)
ap.add_argument("-e", "--encodings", required=True)
ap.add_argument("-f", "--final", required=True)
ap.add_argument("-c", "--classid", required=True)
ap.add_argument("-w", "--week", required=True)
args = vars(ap.parse_args())
os.system("C:/Python37/python3.exe C:/xampp/htdocs/face/videos/ok3.py --image " + args["image"] + " --output " + args["output"] + "/output/")
os.system("C:/Python27/python2.exe C:/xampp/htdocs/face/videos/ok4.py -e " + args["encodings"] + " -i " + args["output"] + "/output -t " + args["output"] + "/attendance.txt")

if(args["final"] == "1"):
    # GO TAKE ATTENDANCE
    f = open(args["output"] + "/attendance.txt","r+")
    text = f.read()
    c = Counter()
    for line in text.splitlines():
        c.update(line.split())
    present = []
    for student in c:
        if (c[student]>=6):
            present.append(student)
    print("Class of " + args["classid"] + " is over. Present students: ", present)

    u = "root"
    p = ""
    h = "127.0.0.1"
    d = "attendance"
    prt="3307"
    connection = mysql.connector.connect(host=h,user=u,passwd=p,db=d,port=prt)
    if connection.is_connected():
        for s in present:
            query = " UPDATE attendance SET present = 1 WHERE student = " + s + " AND class = " + args["classid"] + " AND date = \"2019-06-02\";"			
            cursor = connection.cursor()
            cursor.execute(query)


    # REMOVE LAST HOUR
    f.close()
    if(os.path.exists(args["output"] + "/attendance.txt")):
        os.remove(args["output"] + "/attendance.txt")

if(os.path.exists(args["output"] + "\\output\\")):
    shutil.rmtree(args["output"] + "\\output\\")
# os.system("del " + args["output"] + "\\output\\*")



