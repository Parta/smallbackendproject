"""
Admin controls for Reports and Companies
"""

from django.contrib import admin
from .forms import CreateCompanyForm
from .models import Report, Company


@admin.register(Report)
class ReportAdmin(admin.ModelAdmin):
    list_display = ['created', 'company', 'fan_count', 'social_media']
    list_filter = ['company']


@admin.register(Company)
class CompanyAdmin(admin.ModelAdmin):
    list_display = ['name', 'page_id']
    form = CreateCompanyForm
    readonly_fields = ['page_id']
