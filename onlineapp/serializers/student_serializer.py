from rest_framework import serializers
from onlineapp.models import *

class StudentSerializer(serializers.ModelSerializer):
    class Meta:
        model = Student
        fields = ('id', 'name', 'dob', 'email', 'db_folder', 'dropped_out', "college")
        read_only_fields = ('id', )