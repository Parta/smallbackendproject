import http.client
import json
import pymongo

conn = http.client.HTTPSConnection("graph.facebook.com")
headers = {'cache-control': "no-cache"}

with open('credentials.json') as credentials_file:
    credentials = json.load(credentials_file)

    conn.request("GET",
                 '/oauth/access_token?client_id={app_id}&client_secret={app_secret}&grant_type=client_credentials'.format(
                     app_id=credentials.get("app_id"), app_secret=credentials.get("app_secret")), headers=headers)

    res = conn.getresponse()
    data = res.read()

    response = json.loads(data.decode("utf-8"))
    access_token = response.get("access_token")

    print(access_token)

    conn.request("GET",
                 "/v2.9/{fan_id}?access_token={access_token}&fields=fan_count&format=table".format(fan_id="cocacola",
                                                                                                   access_token=access_token),
                 headers=headers)

    res = conn.getresponse()
    data = res.read()
    print(data.decode("utf-8"))
