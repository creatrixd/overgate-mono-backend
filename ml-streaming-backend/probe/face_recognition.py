import cv2
import face_recognition
import time
from fastapi import FastAPI
from fastapi.responses import StreamingResponse
import asyncio

app = FastAPI()

known_image = face_recognition.load_image_file("person1.jpg")
known_face_encoding = face_recognition.face_encodings(known_image)[0]
known_face_encodings = [known_face_encoding]
known_face_names = ["ilya"]

cap = cv2.VideoCapture(0)
fps = 10
frame_time = 1 / fps
output_width, output_height = 1280, 720

async def mjpeg_stream_generator():
    prev_time = 0
    while True:
        current_time = time.time()
        if (current_time - prev_time) < frame_time:
            await asyncio.sleep(frame_time - (current_time - prev_time))
        prev_time = current_time

        ret, frame = cap.read()
        if not ret:
            break

        rgb_frame = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)
        face_locations = face_recognition.face_locations(rgb_frame)
        face_encodings = face_recognition.face_encodings(rgb_frame, face_locations)

        gray_frame = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
        display_frame = cv2.cvtColor(gray_frame, cv2.COLOR_GRAY2BGR)

        for (top, right, bottom, left), face_encoding in zip(face_locations, face_encodings):
            matches = face_recognition.compare_faces(known_face_encodings, face_encoding, tolerance=0.5)
            name = "Unknown"
            if True in matches:
                first_match_index = matches.index(True)
                name = known_face_names[first_match_index]
            cv2.rectangle(display_frame, (left, top), (right, bottom), (0, 255, 0), 2)
            cv2.putText(display_frame, name, (left, top - 10),
                        cv2.FONT_HERSHEY_SIMPLEX, 0.9, (0, 255, 0), 2)

        display_frame = cv2.resize(display_frame, (output_width, output_height))

        ret, jpeg = cv2.imencode('.jpg', display_frame)
        if not ret:
            continue
        frame_bytes = jpeg.tobytes()

        yield (b'--frame\r\n'
               b'Content-Type: image/jpeg\r\n\r\n' + frame_bytes + b'\r\n')

@app.get("/video_feed")
def video_feed():
    return StreamingResponse(mjpeg_stream_generator(),
                             media_type='multipart/x-mixed-replace; boundary=frame')

@app.on_event("shutdown")
def shutdown_event():
    cap.release()

# uvicorn fastapi_mjpeg_stream:app --host 0.0.0.0 --port 8000 --reload
