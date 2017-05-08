import http.client
import json
from dal.fan_page_dal import FanRepository

fan_repository = FanRepository()
conn = http.client.HTTPSConnection("graph.facebook.com")


def __request_helper(http_method, uri, body=None, headers={}):
    """

    A little utility function to go extract the payload from facebook graph api.
    :param http_method: The method ex. {GET, POST}
    :param uri: The uri of the resouce you wish to get.
    :param body: None  (to match the method signature of conn.request)
    :param headers: {} (to match the method signature of conn.request)
    :return:

    """
    conn.request(http_method, uri, body=body, headers=headers)
    res = conn.getresponse()
    data = res.read()
    return json.loads(data.decode("utf-8"))


FAN_NAME = "nytimes"
with open('credentials.json') as credentials_file:
    credentials = json.load(credentials_file)
    app_id = credentials.get("app_id")
    app_secret = credentials.get("app_secret")
    response = __request_helper("GET",
                                '/oauth/access_token?client_id={app_id}&client_secret={app_secret}&grant_type=client_credentials'.format(
                                    app_id=app_id, app_secret=app_secret))
    access_token = response.get("access_token")
    response = __request_helper("GET",
                                "/v2.9/{fan_name}?access_token={access_token}&fields=fan_count,name&format=table".format(
                                    fan_name=FAN_NAME,
                                    access_token=access_token))

    fan_repository.insert_fan_count(fan_name=FAN_NAME,
                                    fan_count=response.get("fan_count"),
                                    fan_id=response.get("id"))
