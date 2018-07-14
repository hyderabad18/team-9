from onlineapp.models import *
from onlineapp.serializers import *
from django.views.decorators.csrf import csrf_exempt
# from rest_framework.decorators import api_view
from django.http import JsonResponse, HttpResponse
from rest_framework.parsers import JSONParser
import base64
from django.contrib.auth import authenticate
from rest_framework.response import Response
from rest_framework import status
def basic_auth(func):
    def wrapper(request, *args, **kwargs):
        if 'HTTP_AUTHENTICATION' in request.META:
            auth = request.META['HTTP_AUTHENTICATION'].split()
            if len(auth) == 2:
                if auth[0].lower() == 'basic':
                    username, password = base64.b64encode(auth[1]).split(':', 1)
                    user = authenticate(username = username, password = password)
                    if user is not None:
                        pass
                    else:
                        return Response(status= status.HTTP_401_UNAUTHORIZED)
    return wrapper



@csrf_exempt
def CollegeListRestView(request):
    if request.method == 'GET':
        colleges = College.objects.all()
        serialized_colleges = CollegeSerialize(colleges, many = True)
        return JsonResponse(serialized_colleges.data, safe = False)

    if request.method == 'POST':
        data = JSONParser().parse(request)
        college = CollegeSerialize(data = data)
        if college.is_valid():
            college.save()
            return JsonResponse(college.data['id'], status= 201, safe= True) # 201 is Created
        return JsonResponse(college.errors, status = 400) # 400 is Bad Request

@csrf_exempt
def CollegeStudentRestView(request, pk):

    try:
        college = College.objects.get(pk = pk)
    except College.DoesNotExist:
        return HttpResponse(status= 404) #Not Found

    if request.method == 'GET':
        serialized_college = CollegeSerialize(college)
        return JsonResponse(serialized_college.data)

    if request.method == 'PUT':
        data = JSONParser().parse(request)
        serialized_college = CollegeSerialize(college, data = data)
        if serialized_college.is_valid():
            serialized_college.save()
            return JsonResponse(serialized_college.data)
        return JsonResponse(serialized_college.data, status= 400) #400 is Bad Request

    if request.method == 'DELETE':
        college.delete()
        return HttpResponse(status= 204) #204 means no content

