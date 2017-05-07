from pymongo import MongoClient
from datetime import datetime


class FanRepository():
    def __init__(self, client=None):
        if client:
            self.client = client
        else:
            self.client = MongoClient('localhost:27017')
        self.db = self.client.fan_analytics

    def insert_fan_count(self, fan_name, fan_count, fan_id, time=None):
        if time is None:
            time = datetime.utcnow().isoformat()
        self.db.fan_count.insert_one({
            "fan_name": fan_name,
            "fan_count": fan_count,
            "fan_id": fan_id,
            "time": time
        })
