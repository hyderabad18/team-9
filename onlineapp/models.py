from django.db import models
from django.contrib.auth.models import User
from django.db.models.signals import post_save
from django.dispatch import receiver

# Create your models here.
class College(models.Model):
    name = models.CharField(max_length=128)
    location = models.CharField(max_length=128)
    acronym = models.CharField(max_length=8)
    contact = models.EmailField()

    def __str__(self):
        return self.acronym



class Student(models.Model):
    name = models.CharField(max_length=128)
    dob = models.DateField(null=True, blank=True)
    email = models.EmailField(max_length=256)
    db_folder = models.CharField(max_length=128)
    dropped_out = models.BooleanField(default=False)
    college = models.ForeignKey(College, on_delete = models.CASCADE)
    date = models.DateField()

    def __str__(self):
        return self.name

class MockTest1(models.Model):
    problem1 = models.IntegerField()
    problem2 = models.IntegerField()
    problem3 = models.IntegerField()
    problem4 = models.IntegerField()
    total = models.IntegerField()
    student = models.OneToOneField(Student, on_delete=models.CASCADE)

    def __str__(self):
        return f"Student {self.student} marks"

# class Profile(models.Model):
#     user = models.OneToOneField(User, on_delete=models.CASCADE)
#     bio = models.TextField(max_length=500, blank=True)
#     location = models.CharField(max_length=30, blank=True)
#     birth_date = models.DateField(null=True, blank=True)
#
# @receiver(post_save, sender=User)
# def create_user_profile(sender, instance, created, **kwargs):
#     if created:
#         Profile.objects.create(user=instance)
#
# @receiver(post_save, sender=User)
# def save_user_profile(sender, instance, **kwargs):
#     instance.profile.save()

class Event(models.Model):
    category = models.CharField(max_length=300)
    name = models.CharField(max_length=300)
    description = models.CharField(max_length = 300)
    num_of_vol = models.IntegerField(default = 0)
    progress = models.BooleanField(default=False)
    date = models.DateField()
    user = models.ManyToManyField(User)

    def __str__(self):
        return self.name

class Locatiion(models.Model):
    location = models.CharField(max_length= 300)
    event = models.ForeignKey(Event, on_delete=models.CASCADE)