from rest_framework import serializers
from onlineapp.models import *
from .mocktest_serializer import *

class StudentDetailsSerializer(serializers.ModelSerializer):
    mocktest1 = Mocktest1Serializer(many = False)
    class Meta:
        model = Student
        fields = ('id', 'name', 'dob', 'email', 'db_folder', 'dropped_out', 'mocktest1')
        read_only_fields = ('id',)

    def create(self, validated_data): #should send college_id in validated_data
        student = Student.objects.create(**validated_data ,college = College.objects.get(id = validated_data['college_id']))
        student.save()
        try:
            mocktest_data = validated_data.pop('mocktest1')
            mocktest1 = MockTest1.objects.create(**mocktest_data, student = student)
            mocktest1.save()
        except KeyError:
            pass
        return student

    def update(self, instance, validated_data):
        instance.name = validated_data.get('name', instance.name)
        instance.dob = validated_data.get('dob', instance.dob)
        instance.email = validated_data.get('emain', instance.email)
        instance.db_folder = validated_data.get('db_folder', instance.db_folder)
        instance.dropped_out = validated_data.get('dropped_out', instance.dropped_out)
        instance.save()
        try:
            mocktest_data = validated_data.pop('mocktest1')
            mocktest1 = instance.mocktest1
            mocktest1.problem1 = mocktest_data.get('problem1', mocktest1.problem1)
            mocktest1.problem2 = mocktest_data.get('problem2', mocktest1.problem2)
            mocktest1.problem3 = mocktest_data.get('problem3', mocktest1.problem3)
            mocktest1.problem4 = mocktest_data.get('problem4', mocktest1.problem4)
            mocktest1.total = mocktest_data.get('total', mocktest1.total)
            mocktest1.save()
        except KeyError:
            mocktest1 = MockTest1(problem1=0, problem2=0, problem3=0, problem4=0, total=0)
            mocktest1.student = instance
            mocktest1.save()
        return instance

