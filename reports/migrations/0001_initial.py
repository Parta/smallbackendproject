# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
    ]

    operations = [
        migrations.CreateModel(
            name='Company',
            fields=[
                ('id', models.AutoField(serialize=False, auto_created=True, verbose_name='ID', primary_key=True)),
                ('created', models.DateTimeField(verbose_name='Created at', auto_now_add=True)),
                ('updated', models.DateTimeField(auto_now=True, verbose_name='Updated at')),
                ('name', models.CharField(unique=True, max_length=255)),
                ('page_id', models.CharField(max_length=500)),
            ],
            options={
                'verbose_name': 'Company',
                'verbose_name_plural': 'Companies',
            },
        ),
        migrations.CreateModel(
            name='Report',
            fields=[
                ('id', models.AutoField(serialize=False, auto_created=True, verbose_name='ID', primary_key=True)),
                ('created', models.DateTimeField(verbose_name='Created at', auto_now_add=True)),
                ('updated', models.DateTimeField(auto_now=True, verbose_name='Updated at')),
                ('fan_count', models.IntegerField()),
                ('likes', models.IntegerField(blank=True, null=True)),
                ('total_visits', models.IntegerField(blank=True, null=True)),
                ('company', models.ForeignKey(related_name='company_reports', to='reports.Company')),
            ],
            options={
                'ordering': ('created',),
                'verbose_name': 'Report',
                'verbose_name_plural': 'Reports',
            },
        ),
    ]
