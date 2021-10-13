import cv2
#opencv library for reading image, camera and video 
from pyzbar.pyzbar import decode
# zbar for decding the Barcode and QRcodes
import time

#QR code
# img=cv2.imread('.png')
# print(decodee(img))
cap =cv2.VideoCapture(0)
cap.set(3,640) #width
cap.set(4,480)  #heights
serialno=[]

camera=True
while camera:
    success,frame = cap.read()

    for code in decode(frame):
        if code.data.decode('utf-8') not in serialno:
            print("Approved. ENTER !!")
            print(code.type)
            print(code.data.decode('utf-8'))
            serialno.append(code.data.decode('utf-8'))
            time.sleep(5)
        elif code.data.decode('utf-8') in serialno:
            print("Already REGISTERED")
            time.sleep(5)
        #else:
        #    pass
    
    cv2.imshow("SCAN", frame)
    cv2.waitKey(1)

