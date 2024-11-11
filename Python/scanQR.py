import cv2
import re
import time
import json
from entrada_salida import  insert_entrada



def parse_qr_data(data):
    pattern = r'(\w+)\s*=\s*"([^"]+)"'
    matches = re.findall(pattern, data)
    return {key: value for key, value in matches}

capture = cv2.VideoCapture(0)
qrDetector = cv2.QRCodeDetector()

while(capture.isOpened()):
    ret, frame = capture.read()
    if not ret:
        break
    
    if (cv2.waitKey(1) == ord('s')):
        break

    qrDetector = cv2.QRCodeDetector()
    data, bbox, rectifiedImage = qrDetector.detectAndDecode(frame)

    if bbox is not None and len(data) > 0:
        # Parse the data into a dictionary
        parsed_data = json.loads(data)
        print(parsed_data)
        print(f'cedula: {parsed_data["cedula"]}')
        #print(f'authcode: {parsed_data["authCode"]}')



        time.sleep(1)

        insert_entrada(parsed_data["cedula"], parsed_data["authcode"])

    else:
        cv2.imshow('QR Code', frame)



capture.release()
cv2.destroyAllWindows()