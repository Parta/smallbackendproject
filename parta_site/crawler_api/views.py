# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.shortcuts import render
from django.http import HttpResponse

# Include parta.models
import os, sys
sys.path.append(os.path.abspath(os.path.abspath(os.path.join('..', 'src'))))
from parta.db import Firebase as PartaFirebase

LINECHART_FORMAT = 'linechart'
TABLE_FORMAT = 'table'
MULTIPAGE_FORMAT = 'multiplepage'

def process(data, extra={'format':None, 'page_id':None}):
    """preocess"""
    presentation = None
    if extra['format']:
        presentation = extra['format']
    keys = data.keys()
    stats = {'error':'false', 'data' : None}
    # 
    if presentation == LINECHART_FORMAT:
        dates = []
        for key in keys:
            dates.append({'date' : str(key) ,'value' : str(data[key]['count'])})
        stats = {'error':'false', 'data' : dates}
    else:
        if presentation == TABLE_FORMAT:
            dates = {}
            for key in keys:
                dates[str(key)] = str(data[key]['count'])
            stats = {'error':'false', 'data' : dates}
        else:                    
            if presentation == MULTIPAGE_FORMAT:
                if extra['page_id']:
                    page_id = extra['page_id']
                    dates = {}
                    dates[page_id] = []
                    for key in keys:
                        dates[page_id].append(
                            {   'date' : str(key) ,
                                'value' : str(data[key]['count'])
                            }
                        )
                    stats = {'error':'false', 'data' : dates}
                else:
                    stats = {'error':'true', 'message' : 'Missing parameter page_id!'}
    return stats

# Create your views here.
def index(request):
    """index"""
    import bleach
    
    plateforme = request.GET.get('plateforme')
    if plateforme:
        plateforme = bleach.clean(plateforme).lower()
    else:
        plateforme = ""
    uri = request.GET.get('uri')
    if uri:
        uri = bleach.clean(uri).lower()
    else:
        uri = ""
    page_id = request.GET.get('page_id')
    if page_id:
        page_id = bleach.clean(page_id).lower()
    else:
        page_id = ""
    presentation = request.GET.get('format')
    if presentation:
        presentation = bleach.clean(presentation).lower()
    else:
        presentation = LINECHART_FORMAT
    text = "Nothing to see here"
    if plateforme and page_id and uri and presentation:
        import yaml
        CONFIG_FILE_PATH = os.path.abspath(
            os.path.abspath(os.path.join('..', 'config/config.yaml'))
        )
        config = None
        if not os.path.isfile(CONFIG_FILE_PATH) and not os.access(CONFIG_FILE_PATH, os.R_OK):
            print "Error when accessing config file."\
            " Please check if either the file exists or is readable!"
            exit(1)

        with open(CONFIG_FILE_PATH) as f:
            # use safe_load instead load
            config = yaml.safe_load(f)
        if config:
            # TODO Move the code to a specific module
            import json
            fbase = PartaFirebase(config)
            stats = {'error':'false', 'data' : None}
            tree = 'compaigns/' + page_id + '/entities/' + plateforme + '/components/' + uri + '/elements/stats'
            node = fbase.read(tree)
            data = node.val()               
            if data:
                keys = data.keys()
                extra = {'page_id' : page_id, 'format' : presentation}
                result = process(data, extra)
                if result:
                    stats = result
            else:
                stats = {
                    'error':'true',
                    'message' : 'Error occured when retreiving data from database!',
                    'data' : None
                }
            return HttpResponse(json.dumps(stats), content_type="application/json")
    return HttpResponse(text)
