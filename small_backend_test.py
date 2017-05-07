import http.client
import json

conn = http.client.HTTPSConnection("graph.facebook.com")

headers = {
    'cache-control': "no-cache",
    'postman-token': "ad384b13-4696-3574-724f-7f64aac7d2fe"
}

app_id = "440101389678089"
app_secret = "a8f0e041c0a40a6dd6ff9d3641ce4c48"

conn.request("GET",
             '/oauth/access_token?client_id={app_id}&client_secret={app_secret}&grant_type=client_credentials'.format(
                 app_id=app_id, app_secret=app_secret),
             headers=headers)
res = conn.getresponse()
data = res.read()

access_token = json.loads(data.decode("utf-8")).get("access_token")

conn.request("GET", "/v2.9/nytimes?access_token={access_token}".format(access_token=access_token), headers=headers)

res = conn.getresponse()
data = res.read()
print(data.decode("utf-8"))
