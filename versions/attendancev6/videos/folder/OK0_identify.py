# python OK0_identify.py -i samples/4.png -e model/eleven

import os
import argparse

ap = argparse.ArgumentParser()
ap.add_argument("-i", "--image", required=True)
ap.add_argument("-e", "--encodings", required=True)
args = vars(ap.parse_args())

os.system("rm attendance.txt")
os.system("python3 OK3_saveFaces.py --image " + args["image"])
os.system("python OK4_findID.py -e " + args["encodings"])
os.system("rm outputs/*")



