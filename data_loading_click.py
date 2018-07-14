import os
import django
os.environ.setdefault("DJANGO_SETTINGS_MODULE", "onlineproject.settings")
django.setup()
import click
import openpyxl
import collections
from onlineproject.settings import *
from onlineapp.models import *

@click.group()
def cli():
    pass

@cli.command()
def cleardata():
    """Clears data from database"""
    pass

@cli.command()
def createdb():
    """Creates a database"""
    pass

@cli.command()
def dropdb():
    """Drops a database"""
    pass

def load_college_data(college_worksheet):
    colleges = {}
    firstrow = 1
    for row in college_worksheet.rows:
        if firstrow == 1:
            firstrow = 0
            continue
        college = College(name=row[0].value, acronym=row[1].value.lower(), location=row[2].value, contact=row[3].value)
        colleges[row[1].value.lower()] = college
        college.save()
    return colleges

def load_student_data(students_current_worksheet, students_deletion_worksheet):
    students = {}
    firstrow = 1
    for row in students_current_worksheet.rows:
        if firstrow == 1:
            firstrow = 0
            continue
        student = Student(name = row[0].value, email = row[2].value, db_folder = row[3].value.lower(), college = College.objects.get(acronym = row[1].value.lower()) , dropped_out = False)
        students[row[3].value.lower()] = student
        student.save()
    firstrow = 1
    for row in students_deletion_worksheet.rows:
        if firstrow == 1:
            firstrow = 0
            continue
        student = Student(name=row[0].value, email=row[2].value, db_folder=row[3].value.lower(),
                          college=College.objects.get(acronym = row[1].value.lower()), dropped_out = True)
        students[row[3].value.lower()] = student
        student.save()
    return students

def load_marks_data(marks_worksheet):
    first_row = 1
    for row in marks_worksheet.rows:
        if first_row == 1:
            first_row = 0
            continue
        marks = MockTest1(problem1 = int(row[1].value), problem2 = int(row[2].value), problem3 = int(row[3].value), problem4 = int(row[4].value), total = int(row[5].value), student = Student.objects.get(db_folder = row[0].value.split("_")[2]))
        marks.save()

@cli.command()
#@cli.argument("students_file")
#@cli.argument("marks_file")
def populatedb():
    """Poupulates a database"""
    workbook = openpyxl.load_workbook("students.xlsx")
    college_worksheet = workbook['Colleges']
    students_current_worksheet = workbook['Current']
    students_deletion_worksheet = workbook['Deletions']
    marks_workbook = openpyxl.load_workbook("marks.xlsx")
    marks_worksheet = marks_workbook.active
    load_college_data(college_worksheet)
    load_student_data(students_current_worksheet, students_deletion_worksheet)
    load_marks_data(marks_worksheet)

if __name__ == "__main__":
    cli()