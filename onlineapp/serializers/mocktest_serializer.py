from rest_framework import serializers
from onlineapp.models import *

class Mocktest1Serializer(serializers.ModelSerializer):
    class Meta:
        model = MockTest1
        fields = ('id', 'problem1', 'problem2', 'problem3', 'problem4', 'total')
        read_only_fields = ('id',)