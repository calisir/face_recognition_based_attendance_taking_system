# python ok2.py --dataset /opt/lampp/htdocs/attendance/videos/cng492dataset/ --encodings /opt/lampp/htdocs/attendance/videos/cng492model/cng492

# linux: python ok2.py --dataset /opt/lampp/htdocs/attendance/videos/cng492dataset/ --encodings /opt/lampp/htdocs/attendance/videos/cng492model/cng492


from imutils import paths
import face_recognition
import argparse
import pickle
import cv2
import os

ap = argparse.ArgumentParser()
ap.add_argument("-i", "--dataset", required=True)
ap.add_argument("-e", "--encodings", required=True)
ap.add_argument("-d", "--detection-method", type=str, default="cnn")
args = vars(ap.parse_args())

imagePaths = list(paths.list_images(args["dataset"]))
knownEncodings = []
knownNames = []


for (i, imagePath) in enumerate(imagePaths):

	print("Image {}/{}".format(i + 1, len(imagePaths)))
	name = imagePath.split(os.path.sep)[-2]
	image = cv2.imread(imagePath)
	rgb = cv2.cvtColor(image, cv2.COLOR_BGR2RGB)
	boxes = face_recognition.face_locations(rgb, model=args["detection_method"])
	encodings = face_recognition.face_encodings(rgb, boxes)

	for encoding in encodings:
		knownEncodings.append(encoding)
		knownNames.append(name)


folder = args["encodings"].split("/")[:-1]
folder = "/".join(folder)
print ("x:" + folder)
if not os.path.exists(folder):
    os.mkdir(folder)

data = {"encodings": knownEncodings, "names": knownNames}
f = open(args["encodings"], "wb")
f.write(pickle.dumps(data))
f.close()

print("Done")
