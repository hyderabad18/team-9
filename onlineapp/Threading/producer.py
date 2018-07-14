import threading
class producer(threading.Thread):
    def __init__(self, queue, count, event, lock):
        threading.Thread.__init__(self)
        self.queue = queue
        self.count = count
        self.lock = lock
        self.event = event

    def run(self):
        self.lock.acquire()
        self.queue.put(self.count)
        print("Producer value: ", self.count)
        self.lock.release()
        self.event.set()