"""
Serializers are used like forms. They serialize the data from the database to the format we desire

"""
from rest_framework import serializers
from .models import Company, Report


class ReportSerializer(serializers.ModelSerializer):

    class Meta:
        model = Report
        fields = ('created', 'fan_count')


class CompanySerializer(serializers.ModelSerializer):
    company_reports = ReportSerializer(read_only=True, many=True)

    class Meta:
        model = Company
        fields = ('name', 'company_reports')


class InsertCompanySerializer(serializers.ModelSerializer):

    class Meta:
        model = Company
        fields = ('name', )
