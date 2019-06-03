# python splitVideos_augmente.py -f <path of videos.txt> -o <output folder>
# output: dataset for a class
# ex/ python splitVideos_augmente.py -f cng492Videos -cng492Dataset



import os
import sys
import cv2
import math
import random
import argparse
import numpy as np



parser = argparse.ArgumentParser()
parser.add_argument("-f", "--folderVideos", type=str, default='videos')
parser.add_argument('-o', '--output', type=str, default='dataset')
args = parser.parse_args()



def saveImg(frame, label):
    path = args.output + "/" + label
    if not os.path.exists(path):
        os.makedirs(path)
    name = path + "/" + str(random.randint(111111,999999)) + "_" + str(label) + '.jpg'
    cv2.imwrite(name, frame)



def brightness(img, alpha, beta, label):
    new_img = np.zeros(img.shape, img.dtype)
    alpha = alpha  
    beta = beta    

    for y in range(img.shape[0]):
        for x in range(img.shape[1]):
                new_img[y,x] = np.clip(alpha*img[y,x] + beta, 0, 255)
    saveImg(new_img, label)



def gamma(img, correction, label):
    img = img/255.0
    img = cv2.pow(img, correction)
    img = np.uint8(img*255)
    saveImg(img, label)



def noise(img, prob, label):
    output = np.zeros(img.shape,np.uint8)
    thres = 1 - prob 
    for i in range(img.shape[0]):
        for j in range(img.shape[1]):
            rdn = random.random()
            if rdn < prob:
                output[i][j] = 0
            elif rdn > thres:
                output[i][j] = 255
            else:
                output[i][j] = img[i][j]
    saveImg(output, label)



def resize(img, x, y, label):
    img = cv2.resize(img,(x, y))
    saveImg(img, label)


def main():

    videos = [line.rstrip('\n') for line in open(args.folderVideos)]

    for pathVideo in videos:
        v = cv2.VideoCapture(pathVideo)
        v.set(cv2.CAP_PROP_POS_AVI_RATIO,1)
        videoDuration = int(v.get(cv2.CAP_PROP_POS_MSEC)/1000)-1

        cap = cv2.VideoCapture(pathVideo)
        videoFrameRate = math.floor(cap.get(5))
     
        label = pathVideo.split("/")[-1].split(".")[0]
        print(label)

        if not os.path.exists(args.output + "/" + label):
            os.makedirs(args.output + "/" + label)

        currentSecond = currentFrameNumber = 0
        while(currentSecond != videoDuration):

            ret, frame = cap.read()

            if (ret != True):
                break

            if(currentFrameNumber == videoFrameRate):
                currentFrameNumber = 0
                currentSecond += 1

            if(currentFrameNumber == 0):
                frame = cv2.resize(frame,(128, 128))
                (rows, cols) = frame.shape[:2] 
                M = cv2.getRotationMatrix2D((cols / 2, rows / 2), 270, 1) 
                frame = cv2.warpAffine(frame, M, (cols, rows))  
                saveImg(frame, label)

                #brightness(frame, 2.0, 80, label)
                #gamma(frame, 3.0, label)
                #noise(frame, 0.05, label)
                #resize(frame, 32, 32, label)
               
            currentFrameNumber += 1

        cap.release()



if __name__ == "__main__":
    main()


