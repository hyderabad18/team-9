from django.shortcuts import render
from django.http import *
from django.template import loader
from onlineapp.models import *
# Create your views here.
def hello_world(request):
    #return HttpResponse("HELLO WORLD")
    with open('sample_html.html') as fp:
        read_data = fp.read()
    return HttpResponse(read_data)

def display_colleges(request):
    # display_string = ""
    # college_obj = College.objects.values('name', 'acronym')
    # for college in college_obj:
    #     display_string += '<p>' + college['name'] + '&nbsp&nbsp&nbsp' + college['acronym'].upper() + '</p>'
    # return HttpResponse(display_string)
    response = HttpResponse()
    college_obj = College.objects.values('name', 'acronym')
    for college in college_obj:
        response.write('<p>' + college['name'] + '&nbsp&nbsp&nbsp' + college['acronym'] + '</p>')
    return response

def hello_world_template(request):
    #req = HttpRequest.read('sample_html.html')
    #template = loader.get_template('sample_html.html')
    return render(request = request, template_name= "sample_html.html", content_type='text/html')

def display_college_templates(request):
    college_obj = College.objects.values('name', 'acronym')
    context = {'college_list': college_obj}
    return render(context = context, request= request, template_name= "college_list.html")

def display_stud_college_list(request):
    obj = Student.objects.values('name', 'email', 'college__acronym')
    context = {'stud_college_list': obj}
    return render(request= request, context= context, template_name= 'student_college_list.html')

def display_student_particular(request, id_filter = -1):
    obj = Student.objects.values('name', 'email', 'college__acronym') .filter(id = id_filter)
    #obj = Student.objects.get(id = id_filter)
    context = {'stud_college_list': obj}
    return render(request= request, context= context, template_name= 'student_college_list.html')

def stud_specific_college(request, acronym):
    studs = Student.objects.values("name", "email", "mocktest1__total").filter(college__acronym = acronym).order_by("-mocktest1__total")
    context = {"stud_specific" : studs}
    return render(request= request, context= context, template_name= "specific_clg_studs.html")

def button_stud_marks(request):
    studs = Student.objects.values("name", "email", "mocktest1__total")
    context = {"stud_specific": studs}
    return render(request=request, context=context, template_name="button_stud_marks.html")

def session_view(request):
    cur_session = request.session
    if 'count' not in cur_session:
        cur_session['count'] = 1
    else:
        cur_session['count'] += 1
    return HttpResponse(cur_session['count'])
