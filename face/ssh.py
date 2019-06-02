# python3 ssh.py <ip> <photo location>
# python3 ssh.py 10.42.0.134 cng492

import os
import sys
import time
import paramiko
from time import gmtime, strftime

ip = sys.argv[1]
imageLocation = sys.argv[2]

c = paramiko.SSHClient()
c.set_missing_host_key_policy(paramiko.AutoAddPolicy()) 
c.connect(ip, port=22, username="pi", password="ytr")

# exec command and return
"""
stdin, stdout, stderr = c.exec_command("hostname -I")
opt = stdout.readlines()
opt = "".join(opt)
print(opt)
"""

# create directory if not exists
if not os.path.exists(imageLocation):
    os.makedirs(imageLocation)

# get curretn time 
currentTime = strftime("%Y-%m-%d_%H-%M-%S", gmtime())

# take photo
c.exec_command("raspistill -o img.jpg")

# wait for taking photo
time.sleep(10) 

# send the photo to local
ftp_client=c.open_sftp()
ftp_client.get("img.jpg", imageLocation + "/" + currentTime + ".jpg")
ftp_client.close()
