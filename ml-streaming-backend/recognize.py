import cv2
from ultralytics import YOLO
import re
import drawing
import numpy
import fast_plate_ocr
from fast_plate_ocr import LicensePlateRecognizer

from support import assign_to_car, plate_in_good_format, format_plate_text, allowed_chars, allowed_numbers
from drawing import draw_box, put_text

class PlateResult:
    def __init__(self, car_id, car_box, plate_box, plate_conf, text, text_conf):
        self.__car_id = car_id
        self.__car_box = car_box
        self.__plate_box = plate_box
        self.__plate_conf = plate_conf
        self.__text = text
        self.__text_conf = text_conf

    @property
    def car_id(self):
        return self.__car_id

    @property
    def car_x1(self):
        return self.__car_box[0]

    @property
    def car_y1(self):
        return self.__car_box[1]

    @property
    def car_x2(self):
        return self.__car_box[2]

    @property
    def car_y2(self):
        return self.__car_box[3]

    @property
    def plate_x1(self):
        return self.__plate_box[0]

    @property
    def plate_y1(self):
        return self.__plate_box[1]

    @property
    def plate_x2(self):
        return self.__plate_box[2]

    @property
    def plate_y2(self):
        return self.__plate_box[3]

    @property
    def plate_conf(self):
        return self.__plate_conf

    @property
    def text(self):
        return self.__text
    
    @property
    def text_conf(self):
        return self.__text_conf

class Recognizer:
    def __init__(self, plate_detection_model_: str, gpu=True):
        self.plate_detection_model = YOLO(plate_detection_model_)
        self.lpr = LicensePlateRecognizer('cct-xs-v1-global-model', plate_config_path=fast_plate_ocr.inference.config.PlateOCRConfig(max_plate_slots=8, alphabet=allowed_chars+allowed_numbers, pad_char="", img_height=0, img_width=0))
        self.car_classes = (2, 3, 5, 7,)
        pass

    def read_license_plate(self, plate_crop, frame):

        detections = self.lpr.run(plate_crop)
        for detection in detections:
            if plate_in_good_format(detection):
                return detection, True

        return "".join(detections), False


    def correct_rotation_and_crop(self, frame):
        gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
        blurred = cv2.GaussianBlur(gray, (5, 5), 0)
        edged = cv2.Canny(blurred, 30, 200)

        contours, _ = cv2.findContours(edged.copy(), cv2.RETR_TREE, cv2.CHAIN_APPROX_SIMPLE)

        contours = sorted(contours, key=cv2.contourArea, reverse=True)[:10]

        license_plate_contour = None

        for cnt in contours:
            peri = cv2.arcLength(cnt, True)
            approx = cv2.approxPolyDP(cnt, 0.018 * peri, True)

            if len(approx) == 4:
                license_plate_contour = approx
                break

        if license_plate_contour is None:
            return frame

        rect = cv2.minAreaRect(license_plate_contour)
        box = cv2.boxPoints(rect)
        box = numpy.int8(box)

        angle = rect[-1]
        if angle < -45:
            angle = 90 + angle

        center = tuple(numpy.array(rect[0]))
        size = (int(rect[1][0]), int(rect[1][1]))

        M = cv2.getRotationMatrix2D(center, angle, 1.0)
        rotated = cv2.warpAffine(frame, M, (frame.shape[1], frame.shape[0]))

        x, y = int(center[0] - size[0]/2), int(center[1] - size[1]/2)
        cropped = rotated[y:y+size[1], x:x+size[0]]

        if cropped.ndim == 2:
            cropped = cv2.cvtColor(cropped, cv2.COLOR_GRAY2BGR)

        return cropped

    def enchance_plate(self, frame):
        gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
        clahe = cv2.createCLAHE(clipLimit=2.0, tileGridSize=(8,8))
        gray = clahe.apply(gray)
        
        blurred = cv2.GaussianBlur(gray, (3,3), 2)
        
        edges = cv2.Canny(blurred, threshold1=50, threshold2=150)
        
        kernel = cv2.getStructuringElement(cv2.MORPH_RECT, (5,5))
        
        dilated = cv2.dilate(edges, kernel, iterations=1)
        
        # closed = cv2.morphologyEx(dilated, cv2.MORPH_CLOSE, kernel, iterations=2)
                
        result = cv2.bitwise_and(blurred, dilated)
        
        result = cv2.cvtColor(result, cv2.COLOR_GRAY2BGR)
        
        return result

    def enchance_plate2(self, frame):
        scale_percent = 200
        width = int(frame.shape[1] * scale_percent / 100)
        height = int(frame.shape[0] * scale_percent / 100)
        dim = (width, height)
        resized = cv2.resize(frame, dim, interpolation=cv2.INTER_LANCZOS4)
        
        lab = cv2.cvtColor(resized, cv2.COLOR_BGR2LAB)
        l, a, b = cv2.split(lab)
        clahe = cv2.createCLAHE(clipLimit=2.0, tileGridSize=(8,8))
        cl = clahe.apply(l)
        limg = cv2.merge((cl,a,b))
        final_img = cv2.cvtColor(limg, cv2.COLOR_LAB2BGR)
        
        denoised = cv2.bilateralFilter(final_img, d=9, sigmaColor=75, sigmaSpace=75)

        blurred = cv2.GaussianBlur(denoised, (3,3), 2)

        return blurred

    def detect_plates_in_frame(self, frame):
        gray_image = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
        normalized_gray_image = cv2.normalize(
            gray_image, None, alpha=0, beta=255, norm_type=cv2.NORM_MINMAX)
        normalized_color_image = cv2.cvtColor(
            normalized_gray_image, cv2.COLOR_GRAY2BGR)

        plates = self.plate_detection_model(normalized_color_image)[0]
        results: PlateResult = []
        for plate in plates.boxes.data.tolist():
            x1, y1, x2, y2, score, class_id = plate
                
            plate_crop = normalized_color_image[int(y1):int(y2), int(x1):int(x2), :]

            plate_enchanced = self.enchance_plate2(plate_crop)

            # gray_plate_crop = cv2.cvtColor(plate_crop, cv2.COLOR_BGR2GRAY)

            # _, plate_threshold = cv2.threshold(gray_plate_crop, 64, 255, cv2.THRESH_BINARY_INV)

            plate_text, text_valid = self.read_license_plate(plate_enchanced, normalized_color_image)

            # frame[0:plate_enchanced.shape[0], 0:plate_enchanced.shape[1], :] = plate_enchanced

            draw_box(frame, (int(x1), int(y1),), (int(x2), int(y2)), (255, 127, 127), 2)
            
            if text_valid:
                results.append(PlateResult(-1, [x1, y1, x2, y2], [x1, y1, x2, y2], score, plate_text[:-1], text_valid))

        return results


    def draw_on_frame(self, frame, detected_plates: list[PlateResult]):

        for plate in detected_plates:

            draw_box(frame, (int(plate.plate_x1), int(plate.plate_y1)), (int(plate.plate_x2), int(plate.plate_y2)), (0, 255, 0), 5)
            put_text(frame, plate.text, (0, 0, 255), (int(plate.plate_x1), int(plate.plate_y1),))

        return frame


    def recognize_and_draw(self, frame):
        
        detected_plates = self.detect_plates_in_frame(frame)
        return self.draw_on_frame(frame, detected_plates), detected_plates
    


