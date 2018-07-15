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
from django.views.decorators.csrf import csrf_protect

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
    # success_url = urls.reverse_lazy('onlineapp:firstpage')

    def get_context_data(self, **kwargs):
        context = super(CreateEventView, self).get_context_data(**kwargs)
        form = CreateEventForm()
        context.update({'form': form})
        return context

    def post(self, request, *args, **kwargs):
        form = CreateEventForm(request.POST)
        if form.is_valid():
            event = form.save(commit = False)
            event.save()
            return redirect('onlineapp:location', **{'event_id':event.id})
            return render(request = request, template_name='location_add.html', context= {'event_id': event.id})
        else:
            context = {'form': CreateEventForm(), **form.errors}
            return render(request=request, template_name='home.html', context=context)

class EducationView(LoginRequiredMixin, ListView):
    login_url = '/login'
    model = Event
    template_name = 'event.html'

    def get_context_data(self, *, object_list=None, **kwargs):
        context = super(EducationView, self).get_context_data(**kwargs)
        context['data'] = Event.objects.values('id', 'name', 'date').filter(category='Education', progress=0)
        if self.request.user.get_all_permissions():
            context['isadmin'] = True
        return context

class HealthView(LoginRequiredMixin, ListView):
    login_url = '/login'
    model = Event
    template_name = 'event.html'

    def get_context_data(self, *, object_list=None, **kwargs):
        context = super(HealthView, self).get_context_data(**kwargs)
        context['data'] = Event.objects.values('id', 'name', 'date').filter(category = 'Health', progress = 0)
        return context

class EnvironmentView(LoginRequiredMixin, ListView):
    login_url = '/login'
    model = Event
    template_name = 'event.html'

    def get_context_data(self, *, object_list=None, **kwargs):
        context = super(EnvironmentView, self).get_context_data(**kwargs)
        context['data'] = Event.objects.values('id', 'name', 'date').filter(category = 'Environment', progress = 0)
        return context

class DisableView(LoginRequiredMixin, ListView):
    login_url = '/login'
    model = Event
    template_name = 'event.html'

    def get_context_data(self, *, object_list=None, **kwargs):
        context = super(DisableView, self).get_context_data(**kwargs)
        context['data'] = Event.objects.values('id', 'name', 'date').filter(category = 'Disable', progress = 0)
        return context

class EventsDisplayView(LoginRequiredMixin, ListView):
    login_url = '/login'
    template_name = 'description.html'
    model = Event

    def get_context_data(self, *, object_list=None, **kwargs):
        context = super(EventsDisplayView, self).get_context_data(**kwargs)
        context['descrip'] = Event.objects.values('description').filter(id = self.kwargs['id'])
        return context


def Haveinterest(request, **kwargs):
    user = request.user
    event = Event.objects.get(id=kwargs['id'])
    event.user.add(user)
    return redirect('onlineapp:firstpage')

# def AddVol(request):
#     return render(request = request, template_name='categories.html')

class AssignVol(LoginRequiredMixin, ListView):
    login_url = '/login'
    template_name = 'assignvol.html'
    model = Event

    def get_context_data(self, *, object_list=None, **kwargs):
        context = super(AssignVol, self).get_context_data(**kwargs)
        context['users'] = Event.objects.values('user__id' ,'user__first_name', 'user__last_name', 'user__email').filter(id = self.kwargs['id'])
        context['event_id'] = self.kwargs['id']
        return context

def Addpeople(request, **kwargs):
    iterator = iter(request.POST)
    next(iterator)
    event = Event.objects.get(id = kwargs['event_id'])
    for checked_id in iterator:
        user = User.objects.get(id = checked_id)
        event.user.add(user)

class ViewLocation(LoginRequiredMixin, CreateView):
    login_url = '/login'
    template_name = 'location_add.html'
    form_class = LocationForm
    model = Locatiion

    def get_context_data(self, **kwargs):
        context = super(ViewLocation, self).get_context_data(**kwargs)
        form = LocationForm()
        context.update({'form': form})
        return context

    def post(self, request, *args, **kwargs):
        form = LocationForm(request.POST)
        if form.is_valid():
            location = form.save(commit=False)
            event = Event.objects.get(id = kwargs['event_id'])
            location.event = event
            location.save()
            return redirect('onlineapp:location', **{'event_id': event.id})
            # return render(request=request, template_name='location_add.html', context={'event_id': event.id})
        else:
            context = {'form': CreateEventForm(), **form.errors}
            return render(request=request, template_name='home.html', context=context)

def Successpagered(request):
    return render(request=request, template_name='eventsuccess.html')