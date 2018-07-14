from rest_framework import serializers
from onlineapp.models import *

class CollegeSerialize(serializers.Serializer):
    id = serializers.IntegerField(read_only= True)
    name = serializers.CharField(max_length = 128)
    location = serializers.CharField(max_length=128)
    acronym = serializers.CharField(max_length=128)
    contact = serializers.EmailField()

    def create(self, validated_data):
        return College.objects.create(**validated_data)

    def update(self, instance, validated_data):
        instance.name = validated_data.get('name', instance.name)
        instance.location = validated_data.get('location', instance.location)
        instance.acronym = validated_data.get('acronym', instance.acronym)
        instance.contact = validated_data.get('contact', instance.contact)
        instance.save()
        return instance
