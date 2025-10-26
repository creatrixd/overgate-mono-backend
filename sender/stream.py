import cv2
import asyncio
import websockets
import time
import sys
import log
import os


fps = int(os.getenv('TARGET_FPS', 5))

frame_time = 1/fps
prev_frame_time = 0

async def send_frames():

    source = 0
    
    if len(sys.argv) > 1:
        source = sys.argv[1]

    log.info(f"Source is currently {source}")
    log.info(f"Target fps is {fps}")

    uri = "ws://localhost:8000/ws/source"
    cap = cv2.VideoCapture(source)

    global prev_frame_time
    end = False
    while True:
        if end:
            log.info(f"End of source data, quitting")
            break
        try:
            log.info(f"Trying to connect...")
            async with websockets.connect(uri) as websocket:
                while True:
                    time_elapsed = time.time() - prev_frame_time
                    ret, frame = cap.read()
                    if not ret:
                        end = True
                        break
                    
                    if time_elapsed > frame_time:
                        prev_frame_time = time.time()
                        frame = cv2.resize(frame, (1280, 720,))
                        _, jpeg = cv2.imencode('.jpg', frame)
                        await websocket.send(jpeg.tobytes())
                        log.info(f"Sending frame with size: {len(jpeg)}")
                        await asyncio.sleep(frame_time/4)
        except:
            continue
        finally:
            await asyncio.sleep(1)

    cap.release()

asyncio.run(send_frames())