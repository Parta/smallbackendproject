"""
This is where we place all celery async scheduled tasks. In our case we are getting the fan_counts for
all companies. We place an hourly cronjob to fetch the data

If we would like to execute the task every 10minutes, change the crontab to:
@periodic_task(run_every=crontab(minute='*/10'))
"""
from time import sleep
from celery.schedules import crontab
from celery.task import periodic_task, task
from django.utils.timezone import now
from parta.logging import logger
from reports.constants import DATE_TIME_FORMAT
from reports.forms import CreateReportForm
from reports.models import Company, SocialMedia


@periodic_task(run_every=crontab(hour='*', minute=0))
def get_facebook_fan_count_all_companies():
    companies = Company.objects.all()
    for company in companies:
        create_facebook_fan_count.delay(company.id)



@task
def create_facebook_fan_count(company_id):
    company = Company.objects.get(pk=company_id)
    facebook = SocialMedia.objects.get(name='Facebook')

    form = CreateReportForm(data={
        'company': company.id,
        'fan_count': company.get_facebook_fans(),
        'social_media': facebook.id,
    })

    logger.info('Creating Report for {} at {}'.format(company.name, now().strftime(DATE_TIME_FORMAT)))
    if form.is_valid():
        form.save()
        logger.info('Successfully Report for {} at {}'.format(company.name, now().strftime(DATE_TIME_FORMAT)))
    else:
        logger.info('Failed to create Report for {} at {}'.format(company.name, now().strftime(DATE_TIME_FORMAT)))
        logger.info('Form Errors \n {}'.format(form.errors.as_data()))

    # lets be nice to graph api
    sleep(2)
