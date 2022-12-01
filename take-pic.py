# program to capture single image from webcam in python

# importing OpenCV library
import cv2
import time

# initialize the camera
# If you have multiple camera connected with
# current device, assign a value in cam_port
# variable according to that
cam_port = 0
cam = cv2.VideoCapture(cam_port)

timestamp = time.time()
# reading the input using the camera
result, image = cam.read()

# If image will detected without any error,
# show result
if result:

    # saving image in local storage
    cv2.imwrite("./pics/"+str(timestamp)+".png", image)
    print(timestamp)
    f = open("picture.txt", "w")
    f.write(str(timestamp)+".png")
    f.close

# If captured image is corrupted, moving to else part
else:
    print("No image detected. Please! try again")

f = open("./pic-data.txt", "a")
f.write("")
f.close()

text_file = open("opencv-data.txt", "r")
filter = text_file.read()

text_file = open("picture.txt", "r")
picture = text_file.read()
picture = ("./pics/"+str(picture))

print(picture)
pic_data =[]

img = cv2.imread(picture)

img_gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
img_rgb = cv2.cvtColor(img, cv2.COLOR_BGR2RGB)

stop_data = cv2.CascadeClassifier('./data/haarcascades/'+(filter))

found = stop_data.detectMultiScale(img_gray, minSize =(20, 20))

amount_found = len(found)

if amount_found != 0:
    for (x, y, width, height) in found:
        print("Picture: "+(picture)+" x: "+str(x)+" y: "+str(y)+" Width: "+str(width)+" Height: "+str(height))
        # We draw a green rectangle around
        # every recognized sign
        cv2.rectangle(img_rgb, (x, y),(x + height, y + width),(0, 255, 0), 5)
        pic_data.append(str(x)+","+str(y)+","+str(width)+","+str(height))

        f = open("./pic-data.txt", "a")
        f.write((picture)+str(pic_data)+"\n")
        f.close()

else:
    f = open("./pic-data.txt", "a")
    f.write((picture)+"\n")
    f.close()