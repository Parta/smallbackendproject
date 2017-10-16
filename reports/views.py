from django.contrib.auth.mixins import LoginRequiredMixin
from rest_framework import generics, status
from rest_framework.permissions import IsAuthenticated
from rest_framework.renderers import BrowsableAPIRenderer
from rest_framework.response import Response
from rest_framework.views import APIView

from reports.facebookservice import get_page_id
from .models import Report, Company
from .renderers import LineChartRenderer, TableChartRenderer, MultiPageRenderer
from .serializers import CompanySerializer, ReportSerializer, InsertCompanySerializer


class ListChartAPIView(LoginRequiredMixin, generics.ListAPIView):
    """
    Return a list of all fan_count for page with ListChart Formatting

    """
    login_url = '/admin/'
    permission_classes = (IsAuthenticated, )
    serializer_class = ReportSerializer
    renderer_classes = (LineChartRenderer, BrowsableAPIRenderer)

    def get_queryset(self):
        queryset = Report.objects.all()
        name = self.kwargs['page']
        if name is not None:
            queryset = queryset.filter(company__name__istartswith=name)
        return queryset


class TableAPIView(LoginRequiredMixin, generics.ListAPIView):
    """
    Return a list of all fan_count for page with Table Formatting

    """
    login_url = '/admin/'
    permission_classes = (IsAuthenticated, )
    serializer_class = ReportSerializer
    renderer_classes = (TableChartRenderer, BrowsableAPIRenderer)

    def get_queryset(self):
        queryset = Report.objects.all()
        name = self.kwargs['page']
        if name is not None:
            queryset = queryset.filter(company__name__istartswith=name)
        return queryset


class MultiPageAPIView(LoginRequiredMixin, generics.ListAPIView):
    """
    Return a list of all fan_count for page specified with page={page} with MultiPage Formatting

    Example:
        /multipage/?page=cocacolacanada&page=pepsi
    """
    login_url = '/admin/'
    permission_classes = (IsAuthenticated, )
    serializer_class = CompanySerializer
    renderer_classes = (MultiPageRenderer, BrowsableAPIRenderer)

    def get_queryset(self):
        queryset = Company.objects.all()
        companies = self.request.GET.getlist('pages')
        if companies is not None:
            queryset = queryset.filter(name__in=companies).prefetch_related('company_reports')
        return queryset


class InsertNewCompany(LoginRequiredMixin, APIView):
    """
    Insert New Company into the database.

    """
    login_url = '/admin/'

    def post(self, request, format=None):
        serializer = InsertCompanySerializer(data=request.data)
        if serializer.is_valid():
            company = serializer.save()
            page_id = get_page_id(company.name)
            if page_id:
                company.page_id = page_id
                company.save()
            return Response(serializer.data, status=status.HTTP_201_CREATED)
        return Response(serializer.errors, status=status.HTTP_400_BAD_REQUEST)
