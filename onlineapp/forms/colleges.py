from onlineapp.models import *
from django import forms
class CollegeForm(forms.ModelForm):
    class Meta:
        model = College
        exclude = ['id']

class StudentForm(forms.ModelForm):
    class Meta:
        model = Student
        exclude = ['id', 'dob', 'college']
        # widgets = {
        #
        # }

class MockTest1Form(forms.ModelForm):
    class Meta:
        model = MockTest1
        exclude = ['id', 'total', 'student']
        # widgets = {
        #
        # }

class CreateEventForm(forms.ModelForm):
    class Meta:
        model = Event
        exclude = ['id', 'user', 'progress']

class LocationForm(forms.ModelForm):
    class Meta:
        model = Locatiion
        exclude = ['id', 'event']

class AddUser(forms.Form):
    adduser = forms.BooleanField()