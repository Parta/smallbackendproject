import unittest
from service.service import \
    format_multiple_page


class ServiceTest(unittest.TestCase):
    def setUp(self):
        pass

    # TODO: Write tests for failure.
    def test_format_multiple_page(self):
        documents = [{
            '_id': 1,
            'fan_name': 'cocacola',
            'fan_count': 104252773,
            'fan_id': '40796308305',
            'time': '2017-05-08T01:47:48.768239'
        }, {
            '_id': 2,
            'fan_name': 'nytimes',
            'fan_count': 13867990,
            'fan_id': '5281959998',
            'time': '2017-05-08T01:48:26.367440'
        }, {
            '_id': 3,
            'fan_name': 'nytimes',
            'fan_count': 13868016,
            'fan_id': '5281959998',
            'time': '2017-05-08T02:02:55.344854'
        }]
        processed = format_multiple_page(documents, ["cocacola", "nytimes"])
        self.assertEqual(len(processed.get("nytimes")), 2)
        self.assertEqual(len(processed.get("cocacola")), 1)

        self.assertEqual(processed.get("cocacola")[0].get("date"), "1494222468")
        self.assertEqual(processed.get("cocacola")[0].get("value"), 104252773)

    def tearDown(self):
        pass
