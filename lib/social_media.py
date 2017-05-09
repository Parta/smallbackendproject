import datetime

from db.mongodb import MongoDb
from lib.output_format import OutputFormat


class SocialMedia:
    PAGES = 'pages'
    SOCIAL_MEDIA_METRICS = 'social_media_metrics'

    def __init__(self, media):
        """
        Class constructor
        """
        self.db = MongoDb('crawler')
        self.media = media

    def add_metric(self, page_id, name, value):
        """
        Adds a like metric to database
        :param name: 
        :param value: 
        :param page_id: 
        :return: 
        """
        self.db.insert(self.SOCIAL_MEDIA_METRICS, {
            'timestamp': datetime.datetime.utcnow(),
            'media': self.media,
            'page_id': page_id,
            'metric_name': name,
            'metric_value': value
        })

    def add_page(self, page_id):
        """
        Inserts a page into the database
        :param page_id: 
        :return: 
        """
        self.db.insert(self.PAGES, {
            'timestamp': datetime.datetime.utcnow(),
            'media': self.media,
            'page_id': page_id,
        })

    def get_metric(self, page_id, metric_name, out_format):
        """
        Returns a list of page metrics based on a given format
        :param metric_name: 
        :param page_id: 
        :param out_format: 
        :return: 
        """
        condition = {
            'page_id': page_id,
            'media': self.media,
            'metric_name': metric_name
        }

        metrics = list(self.db.find(self.SOCIAL_MEDIA_METRICS, condition))
        metrics = [{'date': m['timestamp'].isoformat(), 'value': m['metric_value']} for m in metrics]

        if out_format == OutputFormat.multiple_page.value:
            return {page_id: metrics}
        elif out_format == OutputFormat.table.value:
            return {m['date']: m['value'] for m in metrics}
        else:
            return metrics

    def get_pages(self):
        """
        Returns a cursor over the 'pages' collection
        :return: 
        """
        return self.db.find(self.PAGES)
