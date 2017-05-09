from time import sleep
from facebook import Facebook
from optparse import OptionParser


def process(page_id=None):
    """
    Persists a metric from a page or multiple pages every one hour
    :param page_id: 
    :return: 
    """
    one_hour = 1 * 60 * 60
    fb = Facebook()
    pages = list(fb.get_pages()) if (page_id is None) else [{'page_id': page_id}]

    while True:
        for page in pages:
            page_id = page['page_id']
            like_count = Facebook.get_fans(page_id)
            fb.add_metric(page_id, 'like', like_count)

        sleep(one_hour)


if __name__ == '__main__':
    parser = OptionParser()
    parser.add_option('-p', '--page_id', dest='page_id',
                      help='facebook page id', default=None)
    (options, args) = parser.parse_args()

    process(options.page_id)
