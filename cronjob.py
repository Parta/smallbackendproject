#!/Users/Ghost/anaconda/bin/python
import sys
from pathlib import Path
import os

from datetime import datetime
from sqlalchemy import create_engine
from sqlalchemy.orm import sessionmaker

from table import PageFanCount, Base
import crawler


def main(argv):
    if (len(sys.argv) != 2):
        sys.exit('Usage: cronjob.py <facebook_page_name>')
    if not database_exists():
        os.system('python table.py')
    data = get_data_to_save(argv[1])
    save_to_database(data)
    print(data.page_name, 'currently has', data.fans, 'fans as of',
          data.time)


def database_exists():
    database_file = Path("/facebook_page_fan_count.db")
    return database_file.is_file()


def init_database():
    try:
        engine = create_engine('sqlite:///facebook_page_fan_count.db')
        Base.metadata.bind = engine
        DBSession = sessionmaker(bind=engine)
        session = DBSession()
        return session
    except:
        raise Exception('Could not start database engine')


def get_data_to_save(page_name):
    try:
        page_name = page_name
        fan_count = crawler.get_fan_count(page_name)
        return PageFanCount(
            page_name=page_name, fans=fan_count, time=datetime.now())
    except:
        raise Exception('Unable to get page information')


def save_to_database(data_to_save):
    try:
        session = init_database()
        session.add(data_to_save)
        session.commit()
    except:
        raise Exception('Unable to save to database')


if __name__ == "__main__":
    main(sys.argv)
