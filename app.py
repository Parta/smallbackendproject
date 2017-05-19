#!flask/bin/python
# -*- coding: utf-8 -*-

import json
from flask import Flask, request

# fb_scraper functions and classes
from fb_scrapper import FacebookScrapper
import db_utils as db
import utils as ut

"""
This file contains all the appropriate functions for the Flask API to work.
"""

###################################################################################################
# Main app
###################################################################################################

app = Flask(__name__)

@app.route('/')
def index():
    
    message = "Welcome to small backend project API !"

    return message

@app.route('/likes_count', methods=["GET"])
def get_likes():
    """
    This endpoint just returns the current number of likes of the selected page if queried and sent a 
    dictionnary of parameters.
    INPUT: data from API.
    OUTPUT: Current count of users.

    Parameter format: {"output":"OUTPUT_TYPE", "page":"PAGE"}
    """

    # Instanciating main class for Facebook call
    fbs = FacebookScrapper()

    # Getting the parameters form the GET request
    output, page = ut.get_default_params(dict(request.args))    

    # Getting the data from the FB scraper
    data_fb = fbs.get_page_fan_count(page=page)
        
    return json.dumps(data_fb)


@app.route('/history', methods=["GET"])
def get_full_data():
    """
    This endpoint returns all the data queried by the cron job and stored in the database, and returns 
    it according to the format specified by the user.
    INPUT: data from API.
    OUTPUT: All data from database to date.

    NOTE: 
        - Parameter format: {"output":"OUTPUT_TYPE", "page":"PAGE"}    
    """

    # Getting the parameters form the GET request
    params = dict(request.args)

    # Getting the parameters form the GET request
    output, page = ut.get_default_params(dict(request.args))     

    # DB query for all data available
    try:
        data = db.get_data_db(page)
        return ut.assemble_response(data_returned=data, output=output)
    except:
        print("[!!!] Error with retrieval the data from database.")
        return {"data": "Internal error", "error": True}

###################################################################################################