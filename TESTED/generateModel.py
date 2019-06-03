# python generateModel.py -m <a name for model (course name)> -d <path of dataset folder> -o <path of model folder>
# output: SVM model, encoded name list of a class
# ex/ python generateModel.py -m cng492 -d data/eleven -o models


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
import gzip 
import json
import joblib
import pickle
import os.path
import argparse
import numpy as np
import _pickle as cPickle
import matplotlib.pyplot as plt
from PIL import Image
from joblib import dump, load
from progressbar import ProgressBar



parser = argparse.ArgumentParser()
parser.add_argument("-m", "--nameModel", type=str)
parser.add_argument("-d", "--dataset", type=str)
parser.add_argument('-o', '--output', type=str)
parser.add_argument('-w', '--weight', type=str, default='weight/vggFaceWeights.h5')
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

model.load_weights(args.weight)
modelVGGFace = Model(inputs=model.layers[0].input, outputs=model.layers[-2].output)



if not os.path.exists(args.output):
    os.makedirs(args.output)



def preprocessImage(pathImage):
    img = load_img(pathImage, target_size=(224, 224))
    img = img_to_array(img)
    img = np.expand_dims(img, axis=0)
    img = preprocess_input(img)
    return img

  

def loadMetadata(pathDataset):
    metadata = []
    for nameClass in os.listdir(pathDataset):
        for nameFile in os.listdir(os.path.join(pathDataset, nameClass)):
            extension = os.path.splitext(nameFile)[1]
            if extension == '.jpg' or extension == '.jpeg' or extension =='.png':
                metadata.append(os.path.join(pathDataset, nameClass, nameFile))
    return np.array(metadata)



def loadImage(pathImage):
    return cv2.imread(pathImage, 1)
  


metadata = loadMetadata(args.dataset)
pbar = ProgressBar()

x = np.zeros((metadata.shape[0], 2622))
for i in pbar(range(len(metadata))):
    img = loadImage(str(metadata[i]))
    img = (img / 255.).astype(np.float32)
    x[i] = modelVGGFace.predict(preprocessImage(str(metadata[i])))[0,:]



yName = np.array([str(m).split('/')[-2] for m in metadata])
encoder = LabelEncoder()
encoder.fit(yName)
y = encoder.transform(yName)

xTrain, xTest, yTrain, yTest = train_test_split(x, y, test_size=0.2, random_state=0)

modelSVC = LinearSVC()
modelSVC.fit(xTrain, yTrain)
accuracySVC = accuracy_score(yTest, modelSVC.predict(xTest))
#print(f'SVM accuracy = {accuracySVC}')



fp = gzip.open(args.output + "/" + args.nameModel + "_encoder.pkl.gz",'wb')
cPickle.dump(encoder, fp)
fp.close()



fp = gzip.open(args.output + "/" + args.nameModel + "_model.pkl.gz",'wb')
cPickle.dump(modelSVC, fp)
fp.close()



sess.close()
