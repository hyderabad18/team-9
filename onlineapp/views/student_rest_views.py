from rest_framework.views import APIView
from onlineapp.models import *
from onlineapp.serializers import *
from django.http import JsonResponse, HttpResponse
from rest_framework import status
from rest_framework.response import Response
from rest_framework.parsers import JSONParser

class StudentListRestView(APIView):

    def get(self, request, **kwargs):
        students = Student.objects.all().filter(college__id = kwargs['college_id'])
        students = StudentSerializer(students, many= True)
        #return JsonResponse(students.data, safe = False)
        return Response(students.data)

    def post(self, request, **kwargs):
        serializer = StudentDetailsSerializer(data = request.data, partial = True)
        if serializer.is_valid():
            serializer.save(college_id = kwargs['college_id']) #save takes kwargs, these kwargs are added to validted_data, see save implementation
            #return JsonResponse(serializer.data['id'], status= status.HTTP_201_CREATED, safe= True)
            return Response(serializer.data['id'], status=status.HTTP_201_CREATED)
        #return JsonResponse(serializer.errors, status= status.HTTP_400_BAD_REQUEST)
        return Response(serializer.errors, status=status.HTTP_400_BAD_REQUEST)

class StudentChangeRestView(APIView):

    def get_object(self, pk, cid):
        try:
            student = Student.objects.get(pk = pk)
            if student.college.id == cid:
                return student
            else:
                return None
        except Student.DoesNotExist:
            #return HttpResponse(status= status.HTTP_404_NOT_FOUND)
            return Response(status=status.HTTP_404_NOT_FOUND)

    def get(self, request, **kwargs):
        object = self.get_object(kwargs['student_id'], kwargs['college_id'])
        if object is None:
            return Response(status=status.HTTP_404_NOT_FOUND)
        object = StudentDetailsSerializer(object)
        #return JsonResponse(object.data)
        return Response(object.data)

    def put(self, request, **kwargs):
        object = self.get_object(kwargs['student_id'], kwargs['college_id'])
        serializer = StudentDetailsSerializer(instance = object, data = request.data, partial= True)
        if serializer.is_valid():
            serializer.save(college_id = kwargs['college_id']) #see explanation of above class save
            return JsonResponse(serializer.data)
        return JsonResponse(serializer.errors, status= status.HTTP_400_BAD_REQUEST)

    def delete(self, request, **kwargs):
        object = self.get_object(kwargs['student_id'], kwargs['college_id'])
        object.delete()
        return Response(status= status.HTTP_204_NO_CONTENT)