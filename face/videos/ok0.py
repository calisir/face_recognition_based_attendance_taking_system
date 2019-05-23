# python OK0_identify.py -i samples/4.png -e model/eleven

import os
import argparse

ap = argparse.ArgumentParser()
ap.add_argument("-i", "--image", required=True)
ap.add_argument("-e", "--encodings", required=True)
args = vars(ap.parse_args())
os.system("del attendance.txt")
os.system("C:/Python37/python3.exe C:/xampp/htdocs/face/videos/ok3.py --image " + args["image"])
os.system("C:/Python27/python2.exe C:/xampp/htdocs/face/videos/ok4.py -e " + args["encodings"])
#os.system("del outputs/*")



