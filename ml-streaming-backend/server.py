from fastapi import FastAPI, WebSocket, WebSocketDisconnect, UploadFile
from fastapi.websockets import WebSocketState
from fastapi.staticfiles import StaticFiles
from fastapi.responses import HTMLResponse, JSONResponse
from fastapi.requests import Request
import cv2
import httpx
import numpy as np
import asyncio
from recognize import Recognizer
from threading import Thread
from uuid import uuid4, UUID
import time
import log
from uvicorn import run

app = FastAPI()

receivers: dict[UUID, WebSocket] = {}

plates_target_url = "http://localhost:8080/api/cars/detected"


@app.websocket("/ws/video")
async def video_receive(websocket: WebSocket):
    identity = uuid4()
    await websocket.accept()
    try:
        receivers[identity] = websocket
        while True:
            await asyncio.sleep(1)

    except WebSocketDisconnect:
        del receivers[identity]
        print("Client disconnected")

@app.post('/plate-number/from-image')
async def detect_plate_number_from_image(images: list[UploadFile]) -> JSONResponse:
    all_detected = []
    for image in images:

        contents = await image.read()
        recognizer = Recognizer('./models/license-plate-finetune-v1m.pt', gpu=False)
        nparr = np.frombuffer(contents, np.uint8)
        img = cv2.imdecode(nparr, cv2.IMREAD_COLOR)
        plates = list(map(lambda p: p.text, recognizer.detect_plates_in_frame(img)))
        all_detected.extend(plates)

    unique = set(all_detected)

    return JSONResponse(list(unique), status_code=200)



@app.websocket("/ws/source")
async def get_source(websocket: WebSocket):
    await websocket.accept()

    try:
        recognizer = Recognizer("./models/license-plate-finetune-v1m.pt", gpu=False)
        async with httpx.AsyncClient() as async_client:
            plates_storage = {}
            plates_last_send_time = {}
            while True:
                data = await websocket.receive_bytes()
                log.info(f"Got frame of size: {len(data)}")
                if len(receivers) == 0:
                    continue
                nparr = np.frombuffer(data, np.uint8)
                frame = cv2.imdecode(nparr, cv2.IMREAD_COLOR)
                frame, plates = recognizer.recognize_and_draw(frame)
                for p in plates:
                    plates_storage[p.text] = True
                    # if p.text in plates_storage.keys():
                    #     plates_storage[p.text] += 1
                    # else:
                    #     plates_storage[p.text] = 1

                _, jpeg = cv2.imencode('.jpg', frame)
                log.info(f"Sending video buffer: ${list(map(lambda v: f"{v.client.host}:{v.client.port}", receivers.values()))}")
                receivers_to_delete = []
                for identity, receiver in receivers.items():
                    try:
                        await receiver.send_bytes(jpeg.tobytes())
                    except Exception as gex:
                        log.info(f"got an exception while sending to receiver: {gex}")
                        receivers_to_delete.append(identity)
                        continue

                if len(receivers_to_delete) > 0:
                    for r in receivers_to_delete:
                        del receivers[r]
                to_send = []
                for p, flag in plates_storage.items():
                    log.info(f"Time to send plates: {p}")
                    if p not in plates_last_send_time.keys() or p in plates_last_send_time.keys() and time.time() - plates_last_send_time[p] > 10:
                        to_send.append(p)
                        plates_last_send_time[p] = time.time()
                        plates_storage[p] = 0

                if len(to_send) > 0:
                    await async_client.post(plates_target_url, data={
                        "plates": to_send,
                    });

                to_send.clear()
                plates_storage.clear()


                # await async_client.post(plates_target_url, data={
                #     "plates": to_send, 
                # });

    except WebSocketDisconnect as ex:
        log.info(f"Client disconnected: {ex}")


HTML = """
<!DOCTYPE html>
<html>
<head>
    <title>Live Stream</title>
</head>
<body>
    <h1>Camera 0</h1>
    <img id="videoStream" width="1280" height="720" alt="Video stream will appear here" />

    <script>
        (function() {
            const videoElement = document.getElementById('videoStream');
            const wsUrl = 'ws://localhost:8000/ws/video';

            const socket = new WebSocket(wsUrl);
            socket.binaryType = 'blob';

            socket.onopen = () => {
                console.log('WebSocket connection established');
            };

            socket.onmessage = (event) => {
                const blob = event.data;
                const url = URL.createObjectURL(blob);
                videoElement.src = url;
                videoElement.onload = () => {
                    URL.revokeObjectURL(url);
                };
            };

            socket.onclose = () => {
                console.log('WebSocket connection closed');
            };

            socket.onerror = (err) => {
                console.error('WebSocket error:', err);
            };
        })();
    </script>
</body>
</html>
"""

@app.get("/")
def index():
    return HTMLResponse(HTML)


if __name__ == "__main__":
    run("server:app", host="0.0.0.0", port=8000, ws_max_size=33554432)