# pylint: disable=invalid-name
# -*- coding: utf-8 -*-
"""
Helpers
"""

STANDARD_TIMESTAMP_LENGTH = 13

def get_parameters():
    """
    get_parameters
    """
    import sys
    import argparse
    parser = argparse.ArgumentParser(
        description='Crawl some page to extract useful data'
    )
    parser = argparse.ArgumentParser()
    parser.add_argument(
        '--plateforme',
        help='One of the social media site: facebook, twitter, instagram'
    )
    parser.add_argument('--uri', help='Key for data to extract')
    parser.add_argument('--page_id', help='Page id')
    arguments = {}
    if len(sys.argv[1:]) >= 1:
        arguments = parser.parse_args()
    else:
        parser.print_help()
    return arguments

def get_timestamp():
    """get_timestamp."""
    import time
    nowStr = str(time.time())
    nowStr = nowStr.replace('.', '')
    floating = STANDARD_TIMESTAMP_LENGTH - len(nowStr)
    return nowStr + ('0' * floating)

class Event(object):
    """
    Event
    """
    pass
