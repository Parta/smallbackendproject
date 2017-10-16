from __future__ import absolute_import, unicode_literals
from os import environ, path
from celery import Celery
from django.conf import settings
import os

PROJECT_NAME = path.basename(path.dirname(__file__))
environ.setdefault('DJANGO_SETTINGS_MODULE', '%s.settings' % PROJECT_NAME)

DATABASES = {
    'default': {
        'ENGINE': 'django.db.backends.postgresql_psycopg2',
        'NAME': os.environ['POSTGRES_DB'],
        'USER': os.environ['POSTGRES_USER'],
        'PASSWORD': os.environ['POSTGRES_PASSWORD'],
        'HOST': 'db',
        'PORT': '5432',
    }
}
app = Celery(PROJECT_NAME)
app.config_from_object('django.conf:settings')
app.autodiscover_tasks(lambda: settings.INSTALLED_APPS)
