from urllib import request
import config
import json


def get_fan_count(facebook_page_name):
    """ Returns the number of fans from the provided Facebook fan page. """

    if (type(facebook_page_name) is not str):
        raise TypeError('Invalid type provided')
    url = build_fan_count_url(facebook_page_name)
    res = request.urlopen(url)
    return json.loads(res.read().decode("utf-8"))['fan_count']


def build_fan_count_url(facebook_page_name):
    """ Takes a Facebook page name and builds a request url. """

    if (type(facebook_page_name) is not str):
        raise TypeError('Invalid type provided')
    page_name_fan_count_url = config.facebook_fan_count.format(
        facebook_page_name)
    access_token = facebook_oauth_token()
    return page_name_fan_count_url + 'access_token=' + access_token


def facebook_oauth_token(app_id=config.facebook_app_config['app_id'],
                         app_secret=config.facebook_app_config['app_secret']):
    """ Returns the access token to make api requests to Facebook.
    Default parameters for app_id and app_secret are provided and
    are mapped to a Facebook application created for this program. """

    if (type(app_id) is not str or type(app_secret) is not str):
        raise TypeError('Invalid type provided')
    graph_api_oauth_url = config.facebook_oauth_url.format(app_id, app_secret)
    raw_access_token = request.urlopen(graph_api_oauth_url).read().decode(
        "utf-8")
    if raw_access_token.startswith('access_token='):
        clean_access_token = raw_access_token[len('access_token='):]
    else:
        raise Exception('Unable to get access token')
    return clean_access_token
