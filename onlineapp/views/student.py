from django.views import View
from django.shortcuts import render
from django.shortcuts import get_object_or_404, redirect
from onlineapp.models import *
from django.views.generic import ListView, CreateView, UpdateView, DeleteView
from onlineapp.forms.colleges import *
from django import urls
from django.contrib.auth.mixins import LoginRequiredMixin, PermissionRequiredMixin

app_name = "onlineapp"

class StudentListView(LoginRequiredMixin ,ListView):
    login_url = '/login/'
    model = Student
    context_object_name = 'stud_college_list'
    template_name = 'student_college_list'

    def get_context_data(self, *, object_list=None, **kwargs):
        context = super(StudentListView, self).get_context_data(**kwargs)
        context['stud_college_list'] = self.model.objects.values('name', 'email', 'college__acronym')
        context['user_permissions'] = self.request.user.get_all_permissions()
        return context

class CreateStudentView(LoginRequiredMixin ,CreateView):
    login_url = '/login/'
    template_name = 'student_form.html'
    model = Student
    form_class = StudentForm
    success_url = urls.reverse_lazy('colleges/')

    def get_context_data(self, **kwargs):
        context = super(CreateStudentView, self).get_context_data(**kwargs)
        test_form = MockTest1Form()
        context['user_permissions'] = self.request.user.get_all_permissions()
        context.update(
            {
                'student_form': context.get('form'),
                'marks_form': test_form
            }
        )
        return context

    def post(self, request, *args, **kwargs):
        college = get_object_or_404(College, pk = kwargs.get('college_id'))
        student_form = StudentForm(request.POST)
        test_form = MockTest1Form(request.POST)
        if student_form.is_valid():
            student = student_form.save(commit = False)
            student.college = college
            student.save()
            if test_form.is_valid():
                test = test_form.save(commit = False)
                test.student = student
                test.total = sum(test_form.cleaned_data.values())
                test.save()
        return redirect("onlineapp:student_college_list", **{'college_id': self.kwargs.get('college_id')})

    def get_success_url(self):
        return redirect("onlineapp:student_college_list", **{'college_id': self.kwargs.get('college_id')}).url

class UpdateStudentView(LoginRequiredMixin , PermissionRequiredMixin ,UpdateView):
    login_url = '/login/'
    permission_required = 'onlineapp.change_student'
    permission_denied_message = 'user doesnot have permission to change a student'
    model = Student
    template_name = 'student_form.html'
    form_class = StudentForm

    def get_context_data(self, **kwargs):
        context = super(UpdateStudentView, self).get_context_data(**kwargs)
        student = context.get('student')
        test_form = MockTest1Form(instance= student.mocktest1)
        context.update(
            {
                'student_form': context.get('form'),
                'marks_form': test_form
            }
        )
        return context


    def post(self, request, *args, **kwargs):
        student = Student.objects.get(pk = kwargs.get('pk'))
        mock_test = student.mocktest1
        student_form = StudentForm(request.POST, instance= student)
        test_form = MockTest1Form(request.POST, instance= mock_test)
        test = test_form.save(commit = False)
        student = student_form.save(commit = False)
        test.total = sum(test_form.cleaned_data.values())
        student.save()
        test.save()
        return redirect("onlineapp:student_college_list", **{'college_id': self.kwargs.get('college_id')})

class DeleteStudentView(LoginRequiredMixin, PermissionRequiredMixin ,DeleteView):
    login_url = '/login/'
    permission_required = 'onlineapp.delete_student'
    permission_denied_message = "user does not have permission to change a student"
    model = Student
    template_name = 'college_delete.html'

    def get_success_url(self):
        return redirect("onlineapp:student_college_list", **{'college_id': self.kwargs.get('college_id')}).url
