#!/Users/mmukandila/code/python_code/basic_crawler/crawler_env/bin/python
"""
Description
-----------

Basic fan page crawler for Facebook pages.
"""
import datetime
import logging
import logging.handlers
import os.path
import requests
import sqlite3
import string
import sys

from argparse import ArgumentParser

FB_API_VERSION = 'v2.8'
FB_ACCESS_TOKEN = "<FACEBOOK_APP_TOKEN>"
FB_DEFAULT_FAN_PAGE = 'cocacola'
FB_BASE_URL = string.Template("https://graph.facebook.com/$API_VERSION/$FAN_PAGE")

DEFAULT_DB_PATH = "db/fan_count.db"

rootLogger = logging.getLogger('')
rootLogger.setLevel(logging.DEBUG)
handler = logging.handlers.RotatingFileHandler("log/crawler.log", maxBytes=50*1024, backupCount=5)
formatter = logging.Formatter('%(asctime)s %(process)d %(levelname)s %(message)s')
handler.setFormatter(formatter)
rootLogger.addHandler(handler)

def fetch_count(fan_page_id=None):
    
    if not fan_page_id:
        fan_page_id = FB_DEFAULT_FAN_PAGE

    request_url = FB_BASE_URL.substitute(API_VERSION=FB_API_VERSION, FAN_PAGE=fan_page_id)
    params = dict(fields="fan_count", access_token=FB_ACCESS_TOKEN)

    logging.info("Requesting fan count from: %s" % request_url)

    r = requests.get(request_url, params=params)
    response = r.json()

    logging.info("Connecting to database")
    conn = sqlite3.connect('db/fan_count.db')
    fan_count = response['fan_count']
    timestamp = datetime.datetime.now()

    cur = conn.cursor()
    insertNewCount = "INSERT INTO fan_tracker (fb_page_id, fan_count, time_stamp) VALUES (?,?,?)"
    cur.execute(insertNewCount, (fan_page_id, fan_count, timestamp))
    logging.info("INSERTING IN fan_tracker table")

    logging.info("Committing to database")
    conn.commit()

    logging.info("Closing connection")
    conn.close()

def init_db():
    createTableSql = """
    CREATE TABLE fan_tracker (
        id INTEGER PRIMARY KEY,
        fb_page_id TEXT NOT NULL,
        fan_count INTEGER NOT NULL,
        time_stamp TEXT NOT NULL
    )
    """
    logging.info("Creating fan_tracker table")
    conn = sqlite3.connect(DEFAULT_DB_PATH)
    cur = conn.cursor()
    cur.execute(createTableSql)
    conn.commit()


if __name__ == "__main__":

    if not os.path.exists(DEFAULT_DB_PATH):
        init_db()

    fan_page = None
    parser = ArgumentParser(usage="usage %prog [options]\n"+__doc__)
    parser.add_argument("--page_id", type=str, help="The facebook fan page id. i.e: www.facebook.com/page_id_string")
    args = parser.parse_args()
    
    if args.page_id:
        fan_page = str(args.page_id).strip()

    fetch_count(fan_page)
