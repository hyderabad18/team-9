from onlineapp.forms.auth import SignUpForm, LoginForm
from django.views import View
from django.shortcuts import render, redirect
from django.contrib.auth import authenticate, login, logout
from django.contrib.auth.models import User


class SignUpView(View):
    def get(self, request):
        form = SignUpForm()
        return render(request= request, template_name= "signup_template.html", context={
            'form': form,
        })

    def post(self, request):
        form = SignUpForm(request.POST)
        if form.is_valid():
            User.objects.create_user(**form.cleaned_data)
            user = authenticate(request,
                username = form.cleaned_data['username'],
                password = form.cleaned_data['password']
            )
            if user is not None:
                login(request, user)
                return redirect("onlineapp:firstpage")
            else:
                return redirect("onlineapp:signup")

# class LoginView(View):
#     def get(self, request):
#         if request.user.is_authenticated:
#             return redirect('onlineapp:college_list')
#         form = LoginForm()
#         return render(request= request, template_name = "login_template.html", context={'form': form})
#
#     def post(self, request):
#         form = LoginForm(request.POST)
#         if form.is_valid():
#             user = authenticate(request,
#                                 username=form.cleaned_data['username'],
#                                 password=form.cleaned_data['password']
#                                 )
#             if user is not None:
#                 login(request, user)
#                 return redirect("onlineapp:college_list")
#             else:
#                 return redirect("onlineapp:login")

class LoginView(View):
    def get(self, request):
        # if request.user.is_authenticated:
        #     return redirect('onlineapp:firstpage')
        form = LoginForm()
        return render(request = request, template_name='login_template.html', context={'form': form})

    def post(self, request):
        form = LoginForm(request.POST)
        if form.is_valid():
            user = authenticate(request = request,
                                username = form.cleaned_data['username'],
                                password = form.cleaned_data['password'])
            if user is not None:
                login(request, user)
                return redirect('onlineapp:firstpage')
            else:
                return redirect('onlineapp:login')

def logout_user(request):
    logout(request)
    return redirect('onlineapp:login')