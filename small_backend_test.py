import http.client
import json
from pymongo import MongoClient
from datetime import datetime

# Default  MongoDb Port
# TODO refactor this to a DAL
client = MongoClient('localhost:27017')
db = client.fan_analytics

conn = http.client.HTTPSConnection("graph.facebook.com")

with open('credentials.json') as credentials_file:
    credentials = json.load(credentials_file)
    conn.request("GET",
                 '/oauth/access_token?client_id={app_id}&client_secret={app_secret}&grant_type=client_credentials'.format(
                     app_id=credentials.get("app_id"), app_secret=credentials.get("app_secret")))
    res = conn.getresponse()
    data = res.read()
    response = json.loads(data)
    access_token = response.get("access_token")

    conn.request("GET",
                 "/v2.9/{fan_id}?access_token={access_token}&fields=fan_count,name&format=table".format(
                     fan_id="cocacola",
                     access_token=access_token))

    res = conn.getresponse()
    data = res.read()
    # TODO: Refactor this into an insert.
    to_insert = json.loads(data.decode("utf-8"))
    to_insert.update(time=datetime.utcnow().isoformat())
    db.fan_count.insert_one(to_insert)
