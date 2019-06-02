# python3 saveFaces.py --image 4.png
# Windows : C:/Python37/python3.exe C:/xampp/htdocs/face/videos/ok3.py --image C:/xampp/htdocs/face/videos/demo.png

import os
import cv2
import sys
import datetime
import argparse
import numpy as np

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
parser.add_argument('--model-cfg', type=str, default='C:\\xampp\\htdocs\\face\\videos\\yolov3-face.cfg')
parser.add_argument('--model-weights', type=str, default='C:\\xampp\\htdocs\\face\\videos\\yolov3.weights')
parser.add_argument('--image', type=str, default='')
parser.add_argument('--output', type=str, default='')
args = parser.parse_args()
net = cv2.dnn.readNetFromDarknet(args.model_cfg, args.model_weights)

net.setPreferableBackend(cv2.dnn.DNN_BACKEND_OPENCV)
net.setPreferableTarget(cv2.dnn.DNN_TARGET_CPU)

c = 1
def saveCroppedImage(frame):
    global c
    if not os.path.exists(args.output):
        os.makedirs(args.output)
    cv2.imwrite(args.output + str(c) + ".jpg", frame)
    c += 1


def get_outputs_names(net):
    layers_names = net.getLayerNames()
    return [layers_names[i[0] - 1] for i in net.getUnconnectedOutLayers()]


def draw_predict(frame, conf, left, top, right, bottom):
	# frame[yT:yB , xT:xB]
    saveCroppedImage(frame[int(top*0.85) : int(bottom*1.15), int(left*0.95)  :  int(right*1.05)])

    cv2.rectangle(frame, (left, top), (right, bottom), COLOR_YELLOW, 2)
    text = '{:.2f}'.format(conf)
    label_size, base_line = cv2.getTextSize(text, cv2.FONT_HERSHEY_SIMPLEX, 0.5, 1)
    top = max(top, label_size[1])
    cv2.putText(frame, text, (left, top - 4), cv2.FONT_HERSHEY_SIMPLEX, 0.4, COLOR_WHITE, 1)


def post_process(frame, outs, conf_threshold, nms_threshold):
    frame_height = frame.shape[0]
    frame_width = frame.shape[1]

    confidences = []
    boxes = []
    final_boxes = []
    for out in outs:
        for detection in out:
            scores = detection[5:]
            class_id = np.argmax(scores)
            confidence = scores[class_id]
            if confidence > conf_threshold:
                center_x = int(detection[0] * frame_width)
                center_y = int(detection[1] * frame_height)
                width = int(detection[2] * frame_width)
                height = int(detection[3] * frame_height)
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
        left, top, right, bottom = refined_box(left, top, width, height)
        draw_predict(frame, confidences[i], left, top, right, bottom)
    return final_boxes


def refined_box(left, top, width, height):
    right = left + width
    bottom = top + height
    original_vert_height = bottom - top
    top = int(top + original_vert_height * 0.15)
    bottom = int(bottom - original_vert_height * 0.05)
    margin = ((bottom - top) - (right - left)) // 2
    left = left - margin if (bottom - top - right + left) % 2 == 0 else left - margin - 1
    right = right + margin

    return left, top, right, bottom


def main():
    cap = cv2.VideoCapture(args.image)
    while True:
        has_frame, frame = cap.read()
        if not has_frame:
            cv2.waitKey(1000)
            break
        blob = cv2.dnn.blobFromImage(frame, 1 / 255, (IMG_WIDTH, IMG_HEIGHT), [0, 0, 0], 1, crop=False)
        net.setInput(blob)
        outs = net.forward(get_outputs_names(net))
        faces = post_process(frame, outs, CONF_THRESHOLD, NMS_THRESHOLD)
        frame = frame.astype(np.uint8)

        print('# of faces: {}'.format(len(faces)))
        #cv2.imwrite("hello1.jpg", frame)



if __name__ == '__main__':
    main()
