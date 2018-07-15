"""onlineproject URL Configuration

The `urlpatterns` list routes URLs to views. For more information please see:
    https://docs.djangoproject.com/en/2.0/topics/http/urls/
Examples:
Function views
    1. Add an import:  from my_app import views
    2. Add a URL to urlpatterns:  path('', views.home, name='home')
Class-based views
    1. Add an import:  from other_app.views import Home
    2. Add a URL to urlpatterns:  path('', Home.as_view(), name='home')
Including another URLconf
    1. Import the include() function: from django.urls import include, path
    2. Add a URL to urlpatterns:  path('blog/', include('blog.urls'))
"""
from django.contrib import admin
from django.urls import path
from onlineapp import views
from django.conf import settings
from django.conf.urls import include, url
from onlineapp.views import *
from django.views.decorators.csrf import csrf_exempt
app_name = "onlineapp"

urlpatterns = [
   #  path('colleges/', CollegeListView.as_view(), name = "college_list"),
   #  path('colleges/<int:college_id>', CollegeStudentView.as_view(), name = "student_college_list"), #pk should only be written to identify primary key
   #  path('colleges/add', CreateCollegeView.as_view(), name = "add_colleges"),
   # # path('student/add', CreateStudentView.as_view(), name = "add_student"),
   #  path('colleges/<int:college_id>/add', CreateStudentView.as_view(), name = "add_student"),
   #  path('colleges/<int:pk>/edit', EditCollegeView.as_view(), name = 'edit_college'),
   #  path('colleges/<int:pk>/delete', DeleteCollegeView.as_view(), name = 'delete_college'),
   #  path('colleges/<int:college_id>/<int:pk>/edit', UpdateStudentView.as_view(), name = 'update_student'),
   #  path('colleges/<int:college_id>/<int:pk>/delete', DeleteStudentView.as_view(), name = 'delete_student'),
   #  path('signup/', SignUpView.as_view(), name = 'signup'),
   #  path('login/', LoginView.as_view(), name = 'login'),
   #  path('logout/', logout_user, name = 'logout'),
   #
   #
   #  path('api/v1/colleges/', CollegeListRestView, name = "college_list_rest"),
   #  path('api/v1/colleges/<int:pk>/', CollegeStudentRestView, name = "student_college_rest_list"),
   #
   #  path('api/v1/colleges/<int:college_id>/students/', StudentListRestView.as_view(), name = "student_rest_list"),
   #  path('api/v1/colleges/<int:college_id>/students/<int:student_id>', StudentChangeRestView.as_view(), name = "student_details_rest")

    path('signup/', SignUpView.as_view(), name = 'signup'),
    path('login/', LoginView.as_view(), name = 'login'),
    path('firstpage/', BasepageView.as_view(), name = 'firstpage'),
    path('create_event/', csrf_exempt(CreateEventView.as_view()), name = 'create_event'),
    path('firstpage/education/', EducationView.as_view(), name = 'educationview'),
    path('firstpage/health/', HealthView.as_view(), name = 'healthview'),
    path('firstpage/environment/', EnvironmentView.as_view(), name = 'environmentview'),
    path('firstpage/disable/', DisableView.as_view(), name = 'disableview'),
    path('firstpage/<int:id>/', EventsDisplayView.as_view(), name = 'eventdisplay'),
    path('firstpage/<int:id>/haveinterest/', Haveinterest, name = 'haveinterest'),
    path('firstpage/admin/<int:id>/', AssignVol.as_view(), name = 'assignvaol'),
    path('<int:event_id>/addpeople/', Addpeople, name = 'addpeople'),
    path('create_event/<int:event_id>/', ViewLocation.as_view(), name = 'location'),
    path('addvol/', AddVol, name = 'addvol'),
    path('successpage/', Successpagered, name='successpage')

]
