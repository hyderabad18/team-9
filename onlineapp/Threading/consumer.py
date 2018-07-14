import threading
import time
import requests
class consumer(threading.Thread):
    def __init__(self, queue, event, lock):
        threading.Thread.__init__(self)
        self.queue = queue
        self.event = event
        self.lock = lock

    def run(self):
        time.sleep(1)
        self.event.wait()
        self.lock.acquire()
        college_id, student_id = self.queue.get()
        url = f'http://127.0.0.1:8000/api/v1/colleges/{college_id}/students/{student_id}'
        students_list = requests.get(url)
        student = students_list.json()
        print(student)
        self.lock.release()
        self.event.clear()