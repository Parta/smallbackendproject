import requests
import json
import datetime
import pandas as pd
import time

import utils

"""
This file contains all the appropriate functions for fetching data from Facebook.
"""

#-------------------------------------------------------------------------------------------------#
# Facebook app credentials
#-------------------------------------------------------------------------------------------------#

# Access token and secret for Facebook API
app_id = "253251721815813"
app_secret = "9ede6d43df2014b2c5e077298b8321a2"

# IMPORTANT NOTE: the credentials may not work at the time of the query as they expire. 

#-------------------------------------------------------------------------------------------------#
# Errors handling (exceptions)
#-------------------------------------------------------------------------------------------------#

class FacebookError(Exception):
    """
    Raise this when Facebook returns a error
    """

    def __init__(self, e_log):
        self.msg = json.dumps(e_log)
        self.args = {"Facebook returned the following error: {}".format(self.msg)}

#-------------------------------------------------------------------------------------------------#
# Facebook query functions
#-------------------------------------------------------------------------------------------------#

class FacebookScrapper(object):
    """
    Main class for the Facebook scrapper.
    """

    def __init__(self):
        """
        Constructor of the class.
        """

        # Getting the full Facebook identifier for the query
        self.access_token = app_id + "|" + app_secret


    def get_page_fan_count(self, page):  
        """
        Function that gets the amount of likes from Facebook. 
        INPUT: Page queried + Access token for FB API.
        OUTPUT: Data returned from FB (dict), Time when data is received (str) 
        """

        print("[i] Getting data from Facebook. Please wait.")

        # Fields to query from Facebook API (see FB documentation for details)
        fields = ["fan_count"]
        
        # Request to Facebook API for the page fans count
        url = "https://graph.facebook.com/{}?fields={}&access_token={}".format(page, ",".join(fields), self.access_token)
        data_fb = requests.get(url).json()

        if "error" in data_fb: 
            
            # For local use if needed
            # raise FacebookError(e_log=data_fb["error"])   
            return {"error":True, "response":data_fb["error"]}
        
        else:
            print("[i] Data successfully retrieved :).")
            return {"error":False, "data":[{"date":utils.get_time(time_type="timestamp"), "page":page, "likes":data_fb["fan_count"]}]}

