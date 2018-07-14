import os
import django
os.environ.setdefault("DJANGO_SETTINGS_MODULE", "onlineproject.settings")
django.setup()
from onlineproject.settings import *
from onlineapp.models import *

manager = College.objects
querysets = College.objects.all()
print(querysets)
for queryset in querysets:
    print(queryset)