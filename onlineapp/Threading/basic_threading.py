import requests
import threading
import django
import os
os.environ.setdefault("DJANGO_SETTINGS_MODULE", "onlineproject.settings")
django.setup()

def request(college_id, stud_id):
    url = f'http://127.0.0.1:8000/api/v1/colleges/{college_id}/students/{stud_id}'
    student = requests.get(url)
    student = student.json()
    print(student)
    return student

if __name__ == "__main__":
    college_id = 1
    url = f'http://127.0.0.1:8000/api/v1/colleges/{college_id}/students/'
    students_list = requests.get(url)
    students_list = students_list.json()
    for student in students_list:
        thread = threading.Thread(target = request, args= (college_id, student['id']))
        thread.start()
        thread.join()