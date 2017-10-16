from django.conf.urls import url
from rest_framework.documentation import include_docs_urls
from . import views

urlpatterns = (
    url('^api/fans/linechart/(?P<page>\w+)$', views.ListChartAPIView.as_view(), name='fan-linechart'),
    url('^api/fans/table/(?P<page>\w+)$', views.TableAPIView.as_view(), name='fan-table'),
    url('^api/fans/multipage/', views.MultiPageAPIView.as_view(), name='fan-multipage'),
    url('^api/fans/insertcompany/', views.InsertNewCompany.as_view(), name='fan-multipage'),
    url(r'^docs/', include_docs_urls(title='Parta API', public=False)),
)
