from onlineapp.Threading import *
import queue
import random
def main():
    event = threading.Event()
    lock = threading.Lock()
    q = queue.Queue(maxsize = 10)
    for iter in range(10):
        produce = producer(event = event, lock = lock, queue = q, count = (random.randrange(1, 20), random.randrange(1, 100)))
        consume = consumer(event = event, lock = lock, queue = q)
        produce.start()
        consume.start()
        produce.join()
        consume.join()

if __name__ == "__main__":
    main()