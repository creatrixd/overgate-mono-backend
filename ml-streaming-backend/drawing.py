import cv2


def draw_box(frame, top_left, bottom_right, color, thickness):
    try:
        cv2.rectangle(frame, top_left, bottom_right, color, thickness)
    except Exception as ex:
        print(ex)
        pass


def put_text(frame, text, color, point, font_face=cv2.FONT_HERSHEY_SIMPLEX, font_scale=0.7, thickness=2, line_type=cv2.LINE_AA):
    try:
        cv2.putText(frame, text, point, font_face, font_scale, color, thickness, line_type)
    except Exception as ex:
        pass

