# python2 OK4_findID.py -e model/eleven
import face_recognition
import argparse
import pickle
import cv2
import os
import time
ap = argparse.ArgumentParser()
ap.add_argument("-e", "--encodings", required=True)
ap.add_argument("-d", "--detection-method", type=str, default="cnn")
args = vars(ap.parse_args())

names = set()
for root, dirs, files in os.walk("C://xampp//htdocs//face//videos//outputs"):
	for file in files:
		path = root + "/" + file
		print(path)
		image = cv2.imread(path)
		data = pickle.loads(open(args["encodings"], "rb").read())
		rgb = cv2.cvtColor(image, cv2.COLOR_BGR2RGB)
		boxes = face_recognition.face_locations(rgb, model=args["detection_method"])
		encodings = face_recognition.face_encodings(rgb, boxes)

		for encoding in encodings:
			matches = face_recognition.compare_faces(data["encodings"], encoding)
			name = "Unknown"
		

			if True in matches:
				matchedIdxs = [i for (i, b) in enumerate(matches) if b]
				counts = {}

				for i in matchedIdxs:
					name = data["names"][i]
					counts[name] = counts.get(name, 0) + 1

				name = max(counts, key=counts.get)

				names.add(name)
				print("X: "+name)



print(names)
f=open("C://xampp//htdocs//face//videos//attendance.txt","w")
for name in names:
    f.write("%s\n" % name)
