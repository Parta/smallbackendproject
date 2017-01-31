from sqlalchemy import create_engine
from sqlalchemy.orm import sessionmaker
from table import PageFanCount, Base


engine = create_engine('sqlite:///facebook_page_fan_count.db')
Base.metadata.bind = engine
DBSession = sessionmaker(bind=engine)
session = DBSession()


def fan_count_service(page_name, format=''):
    """ Will call the correct function based on the format
    parameter and returning the current global symbol table.
    Default format is multiple page. All future functions requiring
    data format must use the 'get_fan_count_<format>' convention. """
    if format == '':
        return get_fan_count_multiplepage(page_name)
    return globals()["get_fan_count_" + format](page_name)


def get_fan_count_table(page_name):
    response = {'data': {}, 'error': 'true'}
    try:
        for result in (
                session.query(PageFanCount.fans, PageFanCount.time).filter_by(
                    page_name=page_name).all()):
            response['data'].update({
                result.time.strftime("%H:%M:%S - %m/%d/%Y"): result.fans
            })
        response['error'] = 'false'
    except:
        pass
    return response


def get_fan_count_multiplepage(page_name):
    response = {'data': {page_name: []}, 'error': 'true'}
    try:
        for result in (
                session.query(PageFanCount.fans, PageFanCount.time).filter_by(
                    page_name=page_name).all()):
            response['data'][page_name].append({
                'date': result.time.strftime("%H:%M:%S - %m/%d/%Y"),
                'value': result.fans
            })
        response['error'] = 'false'
    except:
        pass
    return response


def get_fan_count_overtime(page_name):
    response = {'data': [], 'error': 'true'}
    try:
        for result in (
                session.query(PageFanCount.fans, PageFanCount.time).filter_by(
                    page_name=page_name).all()):
            response['data'].append({
                'date': result.time.strftime("%H:%M:%S - %m/%d/%Y"),
                'value': result.fans
            })
        response['error'] = 'false'
    except:
        pass
    return response
