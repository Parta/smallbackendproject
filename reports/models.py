from django.db import models

from reports.constants import DATE_TIME_FORMAT
from reports.facebookservice import get_fan_count


class TimeStampMixin(models.Model):
    created = models.DateTimeField(verbose_name='Created at', auto_now_add=True)
    updated = models.DateTimeField(verbose_name='Updated at', auto_now=True)

    class Meta:
        abstract = True


class Report(TimeStampMixin):
    fan_count = models.IntegerField()
    likes = models.IntegerField(blank=True, null=True)
    total_visits = models.IntegerField(blank=True, null=True)
    company = models.ForeignKey('Company', related_name='company_reports')
    social_media = models.ForeignKey(
        'SocialMedia',
        related_name='social_media_reports',
        on_delete=models.SET_NULL,
        blank=True,
        null=True
    )

    class Meta:
        verbose_name = 'Report'
        verbose_name_plural = 'Reports'
        ordering = ('created', )

    def __str__(self):
        return '{} - {}'.format(self.company.name, self.created.strftime(DATE_TIME_FORMAT))


class Company(TimeStampMixin):
    name = models.CharField(max_length=255, unique=True)
    page_id = models.CharField(max_length=500)

    def __str__(self):
        return self.name

    class Meta:
        verbose_name = 'Company'
        verbose_name_plural = 'Companies'

    def get_facebook_fans(self):
        return get_fan_count(self.page_id)


class SocialMedia(models.Model):
    name = models.CharField(max_length=255, unique=True)
    service_type = models.CharField(max_length=255, blank=True, null=True)

    class Meta:
        verbose_name = 'Social Media'
        verbose_name_plural = 'Social Medias'

    def __str__(self):
        return self.name