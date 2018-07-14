from onlineapp.serializers import *
from onlineapp.models import *
from django.test import TestCase, Client
from rest_framework import serializers

class Rest_Testing(TestCase):

    def TestPost(self):
        client = Client()
        test_dict = College(name =  'Rama Ins', location ='Hyderabad', acronym  ='RI', contact = 'rama@gmail.com')
        serialized_data = CollegeSerializer(test_dict)
        id = client.post('/api/v1/colleges/', serialized_data.data)

        requested_obj = client.get(f'/api/v1/colleges/{id}/')
        import ipdb
        ipdb.set_trace()
        json_data = requested_obj.data
        json_data.pop('id')
        self.assertEqual(serialized_data.data, json_data)
