# python3 ok0.py -i C:\xampp\htdocs\attendance\videos\1.png -e C:\xampp\htdocs\attendance\videos\cng492model\cng492

import os
import argparse

ap = argparse.ArgumentParser()
ap.add_argument("-i", "--image", required=True)
ap.add_argument("-e", "--encodings", required=True)
args = vars(ap.parse_args())

os.system("del attendance.txt")
os.system("python3 ok3.py --image " + args["image"])
os.system("python3 ok4.py -e " + args["encodings"])
#os.system("rm outputs/*")



