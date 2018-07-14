# Generated by Django 2.0.7 on 2018-07-14 16:07

from django.conf import settings
from django.db import migrations, models
import django.db.models.deletion


class Migration(migrations.Migration):

    initial = True

    dependencies = [
        migrations.swappable_dependency(settings.AUTH_USER_MODEL),
    ]

    operations = [
        migrations.CreateModel(
            name='College',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('name', models.CharField(max_length=128)),
                ('location', models.CharField(max_length=128)),
                ('acronym', models.CharField(max_length=8)),
                ('contact', models.EmailField(max_length=254)),
            ],
        ),
        migrations.CreateModel(
            name='Event',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('category', models.CharField(max_length=300)),
                ('name', models.CharField(max_length=300)),
                ('description', models.CharField(max_length=300)),
                ('num_of_vol', models.IntegerField(default=0)),
                ('progress', models.BooleanField(default=False)),
                ('date', models.DateField()),
                ('user', models.ManyToManyField(to=settings.AUTH_USER_MODEL)),
            ],
        ),
        migrations.CreateModel(
            name='Locatiion',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('location', models.CharField(max_length=300)),
                ('event', models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, to='onlineapp.Event')),
            ],
        ),
        migrations.CreateModel(
            name='MockTest1',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('problem1', models.IntegerField()),
                ('problem2', models.IntegerField()),
                ('problem3', models.IntegerField()),
                ('problem4', models.IntegerField()),
                ('total', models.IntegerField()),
            ],
        ),
        migrations.CreateModel(
            name='Student',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('name', models.CharField(max_length=128)),
                ('dob', models.DateField(blank=True, null=True)),
                ('email', models.EmailField(max_length=256)),
                ('db_folder', models.CharField(max_length=128)),
                ('dropped_out', models.BooleanField(default=False)),
                ('date', models.DateField()),
                ('college', models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, to='onlineapp.College')),
            ],
        ),
        migrations.AddField(
            model_name='mocktest1',
            name='student',
            field=models.OneToOneField(on_delete=django.db.models.deletion.CASCADE, to='onlineapp.Student'),
        ),
    ]