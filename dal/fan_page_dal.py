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
        """

        :param fan_name: The fan name to save.
        :param fan_count: The number of fan count in the name.
        :param fan_id: The id for the fan.
        :param time: The time of the fan count.
        :return:
        """
        if time is None:
            time = datetime.utcnow().isoformat()
        self.db.fan_count.insert_one({
            "fan_name": fan_name,
            "fan_count": fan_count,
            "fan_id": fan_id,
            "time": time
        })

    def get_fan_count(self, fan_name, limit=50):
        """

        :param fan_name: The fan name to retrieve.
        :param limit: The number of documents to receive.
        :return: Collection of documents than match a fan name.
        """
        return list(self.db.fan_count.find({
            "fan_name": fan_name
        }).limit(limit))

    def get_fan_counts(self, limit=50, *fan_names):
        """

        :param limit: The number of documents to retrieve
        :param fan_names: A list of fanmes to recieve.
        :return: Collection of documents that match the fan names.
        """
        query = [{"fan_name": fan_name} for fan_name in fan_names]
        return list(self.db.fan_count.find({"$or": query}).limit(limit))
