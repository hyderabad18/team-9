from onlineapp.serialized_classed import *
from onlineapp.models import *
from django.test import TestCase
from rest_framework import serializers

class TestCollegeSerializer(TestCase):
    def setUp(self):
        self.expected_college = College(name = "cbit", location = "Hyderabad", acronym = "cbit", contact = "principal@cbit.ac.in")
        self.serialized_obj = serializers.Serializer(self.expected_college)

    def TestCollegeObj(self):
        self.assertEqual(self.expected_college.name, "cbit")
        self.assertEqual(self.expected_college.location, "Hyderabad")
        self.assertEqual(self.expected_college.acronym, "cbit")
        self.assertEqual(self.expected_college.contact, "principal@cbit.ac.in")


    def TestSerialisedObject(self):
        self.assertNotEqual(self.serialized_obj.data, {"name" : "cbit123", "location" : "Hyderabad", "acronym" : "cbit", "contact" : "principal@cbit.ac.in"})
