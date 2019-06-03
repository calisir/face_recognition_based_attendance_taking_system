# python detectFaces_findIDs.py -i <path class image (input)> -m <path model name (no extebsion)> -o <path folder of attendance list files>
# output: attendance txt list
# ex/ python detectFaces_findIDs.py -i data/class1.jpg -m models/cng492 -o attendance



import keras
from keras import backend as K
from keras.models import model_from_json
from keras.models import Model, Sequential
from keras.preprocessing import image
from keras.preprocessing.image import load_img, save_img, img_to_array
from keras.applications.imagenet_utils import preprocess_input
from keras.layers import Input, Convolution2D, ZeroPadding2D, MaxPooling2D, Flatten, Dense, Dropout, Activation

import tensorflow as tf
from tensorflow.python.client import device_lib

from sklearn.manifold import TSNE
from sklearn.svm import LinearSVC
from sklearn.preprocessing import LabelEncoder
from sklearn.neighbors import KNeighborsClassifier
from sklearn.metrics import f1_score, accuracy_score
from sklearn.model_selection import train_test_split

import cv2
import json
import gzip
import pickle 
import os.path
import argparse
import numpy as np
import _pickle as cPickle
import matplotlib.pyplot as plt
from PIL import Image
from progressbar import ProgressBar



CONF_THRESHOLD = 0.5
NMS_THRESHOLD = 0.4
IMG_WIDTH = 416
IMG_HEIGHT = 416

COLOR_BLUE = (255, 0, 0)
COLOR_GREEN = (0, 255, 0)
COLOR_RED = (0, 0, 255)
COLOR_WHITE = (255, 255, 255)
COLOR_YELLOW = (0, 255, 255)



parser = argparse.ArgumentParser()
parser.add_argument("-i", "--image", type=str)
parser.add_argument("-m", "--model", type=str)
parser.add_argument('-o', '--output', type=str)
parser.add_argument('-v', '--h5', type=str, default='weight/vggFaceWeights.h5')
parser.add_argument('-w', '--weight', type=str, default='weight/face_yolov3.weights')
parser.add_argument('-c', '--cfg', type=str, default='./cfg/face_yolov3.cfg')
args = parser.parse_args()



config = tf.ConfigProto(device_count = {'GPU':1, 'CPU':56}) 
sess = tf.Session(config = config) 
keras.backend.set_session(sess)

print(device_lib.list_local_devices())
K.tensorflow_backend._get_available_gpus()



model = Sequential()
model.add(ZeroPadding2D((1,1),input_shape=(224,224, 3)))
model.add(Convolution2D(64, (3, 3), activation='relu'))
model.add(ZeroPadding2D((1,1)))
model.add(Convolution2D(64, (3, 3), activation='relu'))
model.add(MaxPooling2D((2,2), strides=(2,2)))

model.add(ZeroPadding2D((1,1)))
model.add(Convolution2D(128, (3, 3), activation='relu'))
model.add(ZeroPadding2D((1,1)))
model.add(Convolution2D(128, (3, 3), activation='relu'))
model.add(MaxPooling2D((2,2), strides=(2,2)))

model.add(ZeroPadding2D((1,1)))
model.add(Convolution2D(256, (3, 3), activation='relu'))
model.add(ZeroPadding2D((1,1)))
model.add(Convolution2D(256, (3, 3), activation='relu'))
model.add(ZeroPadding2D((1,1)))
model.add(Convolution2D(256, (3, 3), activation='relu'))
model.add(MaxPooling2D((2,2), strides=(2,2)))

model.add(ZeroPadding2D((1,1)))
model.add(Convolution2D(512, (3, 3), activation='relu'))
model.add(ZeroPadding2D((1,1)))
model.add(Convolution2D(512, (3, 3), activation='relu'))
model.add(ZeroPadding2D((1,1)))
model.add(Convolution2D(512, (3, 3), activation='relu'))
model.add(MaxPooling2D((2,2), strides=(2,2)))

model.add(ZeroPadding2D((1,1)))
model.add(Convolution2D(512, (3, 3), activation='relu'))
model.add(ZeroPadding2D((1,1)))
model.add(Convolution2D(512, (3, 3), activation='relu'))
model.add(ZeroPadding2D((1,1)))
model.add(Convolution2D(512, (3, 3), activation='relu'))
model.add(MaxPooling2D((2,2), strides=(2,2)))

model.add(Convolution2D(4096, (7, 7), activation='relu'))
model.add(Dropout(0.5))
model.add(Convolution2D(4096, (1, 1), activation='relu'))
model.add(Dropout(0.5))
model.add(Convolution2D(2622, (1, 1)))
model.add(Flatten())
model.add(Activation('softmax'))

model.load_weights(args.h5)
modelVGGFace = Model(inputs=model.layers[0].input, outputs=model.layers[-2].output)



if not os.path.exists(args.output):
    os.makedirs(args.output)



def preprocessImage(img):
    img = cv2.resize(img,(224,224))
    img = img_to_array(img)
    img = np.expand_dims(img, axis=0)
    img = preprocess_input(img)
    return img



def getOutputsNames(net):
    layers_names = net.getLayerNames()
    return [layers_names[i[0] - 1] for i in net.getUnconnectedOutLayers()]



def drawPredict(frame, conf, left, top, right, bottom):
    cv2.rectangle(frame, (left, top), (right, bottom), COLOR_RED, 2)
    text = '{:.2f}'.format(conf)
    label_size, base_line = cv2.getTextSize(text, cv2.FONT_HERSHEY_SIMPLEX, 0.5, 1)
    top = max(top, label_size[1])
    cv2.putText(frame, text, (left, top - 4), cv2.FONT_HERSHEY_SIMPLEX, 0.4, COLOR_WHITE, 1)



def postProcess(frame, outs, conf_threshold, nms_threshold):
    frameHeight = frame.shape[0]
    frameWidth = frame.shape[1]

    confidences = []
    boxes = []
    final_boxes = []
    for out in outs:
        for detection in out:
            scores = detection[5:]
            class_id = np.argmax(scores)
            confidence = scores[class_id]
            if confidence > conf_threshold:
                center_x = int(detection[0] * frameWidth)
                center_y = int(detection[1] * frameHeight)
                width = int(detection[2] * frameWidth)
                height = int(detection[3] * frameHeight)
                left = int(center_x - width / 2)
                top = int(center_y - height / 2)
                confidences.append(float(confidence))
                boxes.append([left, top, width, height])

    indices = cv2.dnn.NMSBoxes(boxes, confidences, conf_threshold, nms_threshold)

    for i in indices:
        i = i[0]
        box = boxes[i]
        left = box[0]
        top = box[1]
        width = box[2]
        height = box[3]
        final_boxes.append(box)
        drawPredict(frame, confidences[i], left, top, left + width, top + height)

    return final_boxes



def main():

    frame = cv2.imread(args.image)
    img = cv2.imread(args.image)
    file = open(args.output + "/" + args.model.split("/")[-1] + ".txt", "w") 
    
    fp = gzip.open(args.model + "_encoder.pkl.gz",'rb') 
    encoder = cPickle.load(fp)
    fp.close()

    fp = gzip.open(args.model + "_model.pkl.gz",'rb') 
    modelLoaded = cPickle.load(fp)
    fp.close()

    net = cv2.dnn.readNetFromDarknet(args.cfg, args.weight)
    blob = cv2.dnn.blobFromImage(frame, 1 / 255, (IMG_WIDTH, IMG_HEIGHT), crop=False)
    net.setInput(blob)
    outs = net.forward(getOutputsNames(net))
    faces = postProcess(frame, outs, CONF_THRESHOLD, NMS_THRESHOLD)
    
    for face in faces:
        x0 = face[0]
        y0 = face[1]
        x1 = face[0] + face[2]
        y1 = face[1] + face[3]

        if x0 < 0:
            x0 = 0
        if y0 < 0:
            y0 = 0
        if x1 < 0:
            x1 = 0
        if y1 < 0:
            y1 = 0
        
        cropped = img[y0:y1, x0:x1]
        prediction = modelLoaded.predict([ modelVGGFace.predict(preprocessImage(cropped))[0,:] ])
        id_ = encoder.inverse_transform(prediction)[0]
        
        print(id_ + "\n") 
        file.write(id_ + "\n") 

    sess.close()


    
if __name__ == '__main__':
    main()






