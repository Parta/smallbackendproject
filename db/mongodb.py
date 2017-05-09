from pymongo import MongoClient


class MongoDb:
    def __init__(self, db_name):
        """
        Class constructor
        :param db_name: 
        """
        self.db_name = db_name

    def get_collection(self, collection_name):
        """
        Returns the MongoDB collection object
        :param collection_name: 
        :return: 
        """
        client = MongoClient()
        db = client[self.db_name]
        return db[collection_name]

    def find(self, collection_name, condition=None):
        """
        Returns a cursor instance on a collection for iteration over all documents
        :param condition: 
        :param collection_name: 
        :return: 
        """
        if condition is None:
            condition = {}
        collection = self.get_collection(collection_name)
        return collection.find(condition)

    def insert(self, collection_name, document):
        """
        Inserts a single document into a given collection
        :param collection_name: 
        :param document: 
        :return: 
        """
        collection = self.get_collection(collection_name)
        collection.insert(document)
