import json
import requests
from django.utils.http import urlencode
from parta.logging import logger

FACEBOOK_ACCESS_TOKEN = 'EAAB97EzAynwBACV0M9xHQvGWX6yq4wEZAl6nYcQ7BUZC2XM46dbYXSRaSojYpbkbdQodghko2ZAsu1X3Q0M4tSytGALWgkixsP2qldR1XMn6kS5LzJea8ZCBIs7V2JIOb2uSk3obZAS8wQp0ASnu9buFPjAnYMZATr9V022imXmwZDZD'


def get_fan_count(page_name):
    fields = urlencode({'access_token': FACEBOOK_ACCESS_TOKEN, 'fields': 'fan_count'})
    response = requests.get('https://graph.facebook.com/v2.10/{}?{}'.format(page_name, fields))
    if response.status_code == 200:
        return json.loads(response.text)['fan_count']
    else:
        logger.info('Error in getting_fan_count\n{}', response.text)
        return None


def get_page_id(page_name):
    fields = urlencode({'access_token': FACEBOOK_ACCESS_TOKEN})
    response = requests.get('https://graph.facebook.com/v2.10/{}?{}'.format(page_name, fields))
    if response.status_code == 200:
        return json.loads(response.text)['id']
    else:
        logger.info('Error in getting_fan_count\n{}', response.text)
        return None
