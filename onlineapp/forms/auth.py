from django import forms

class SignUpForm(forms.Form):
    first_name = forms.CharField(
        label= "FirstName",
        max_length=50,
        required= True,
        widget= forms.TextInput()
    )
    last_name = forms.CharField(
        label='LastName',
        max_length= 50,
        required= True,
        widget= forms.TextInput()
    )
    username = forms.CharField(
        label = "UserName",
        max_length= 30,
        required= True,
        widget= forms.TextInput()
    )
    password = forms.CharField(
        label="Password",
        max_length= 30,
        required= True,
        widget= forms.PasswordInput()
    )

class LoginForm(forms.Form):
    username = forms.CharField(
        label="UserName",
        max_length=30,
        required= True,
        widget= forms.TextInput()
    )
    password = forms.CharField(
        label="Password",
        max_length=30,
        required= True,
        widget= forms.PasswordInput()
    )
