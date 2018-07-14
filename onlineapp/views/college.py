from django.views import View
from django.shortcuts import render, redirect
from django.shortcuts import get_object_or_404
from onlineapp.models import *
from django.views.generic import ListView
from django.views.generic import DetailView
from django.views.generic import CreateView
from django.views.generic import UpdateView
from django.views.generic import DeleteView
from onlineapp.forms.colleges import *
from django import urls
from django.contrib.auth.mixins import LoginRequiredMixin, PermissionRequiredMixin

class CollegeView(View): #as we are

    def get(self, request, *args, **kwargs):
        colleges = College.objects.all()
        return render(
            request = request,
            template_name='college_list.html',
            context= {'college_list': colleges}
        )

class CollegeListView(LoginRequiredMixin, ListView):
    login_url = '/login/'
    model = College
    context_object_name = 'college_list'
    template_name = 'college_list.html'

    def get_context_data(self, *, object_list=None, **kwargs):
        context = super(CollegeListView, self).get_context_data(**kwargs)
        #all queries must be written here do a context.update and return context
        context['college_list'] = self.model.objects.all()
        context['user_permissions'] = self.request.user.get_all_permissions()
        return context

class CollegeStudentView(LoginRequiredMixin ,ListView):
    login_url = '/login/'
    model = College
    template_name = 'student_college_list.html'




class CollegeDetailsView(LoginRequiredMixin ,DetailView):
    login_url = '/login/'
    model = College
    template_name = 'student_college_list.html'
    context_object_name = 'stud_college_list'

    def get_object(self, queryset=None):
        return get_object_or_404(College, **self.kwargs)

    def get_context_data(self, **kwargs):
        context = super(CollegeDetailsView, self).get_context_data(**kwargs)
        college = self.get('college')
        student =  college.student_set.order_by("-mocktest1__total")
        context.update(
            {
                'stud_college_list': student
            }
        )
        return context

class CreateCollegeView(LoginRequiredMixin ,CreateView):
    login_url = '/login/'
    template_name = 'college_form.html'
    model = College
    form_class = CollegeForm
    success_url = urls.reverse_lazy('onlineapp:college_list')

class EditCollegeView(LoginRequiredMixin , PermissionRequiredMixin,UpdateView):
    login_url = '/login/'
    permission_required = 'onlineapp.change_college'
    permission_denied_message = "user does not have permission to change a college"
    template_name = 'college_form.html'
    model = College
    form_class = CollegeForm
    success_url = urls.reverse_lazy('onlineapp:college_list')

class DeleteCollegeView(LoginRequiredMixin , PermissionRequiredMixin,DeleteView):
    login_url = '/login/'
    permission_required = 'onlineapp.delete_college'
    permission_denied_message = "user does not have permission to change a college"
    model = College
    template_name = 'college_delete.html'
    success_url = urls.reverse_lazy('onlineapp:college_list')

class BasepageView(LoginRequiredMixin, ListView):
    login_url = '/login'
    template_name = 'home.html'
    model = Event

    def get_context_data(self, *, object_list=None, **kwargs):
        context = super(BasepageView, self).get_context_data(**kwargs)
        if self.request.user.get_all_permissions():
            context['has_perm'] = True
        else:
            context['has_perm'] = False
            context['user_id'] = self.request.user.id
        return context

class CreateEventView(LoginRequiredMixin, CreateView):
    login_url = '/login'
    template_name = 'create_new_event.html'
    form_class = CreateEventForm
    model = Event
    success_url = urls.reverse_lazy('onlineapp:success')

    def get_context_data(self, **kwargs):
        context = super(CreateEventView, self).get_context_data(**kwargs)
        form = CreateEventForm()
        context.update({'form': form})
        return context

    def post(self, request, *args, **kwargs):
        form = CreateEventForm(request.POST)
        if form.is_valid():
            chit = form.save(commit = False)
            chit.people_present = 0
            chit.save()
            return redirect('chit_app:chitlist')
        else:
            context = {'form': CreateEventForm(), **form.errors}
            return render(request=request, template_name='addchit_form.html', context=context)




