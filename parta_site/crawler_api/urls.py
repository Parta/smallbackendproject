"""crawler_api URL Configuration
"""
from django.conf.urls import url, include
from django.contrib import admin
from . import views

urlpatterns = [
    url(r'^get/$', views.index, name="index"),
]