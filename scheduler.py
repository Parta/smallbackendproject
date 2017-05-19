import schedule
import time
import pandas as pd
import numpy as np
import sys

from fb_scrapper import FacebookScrapper
import db_utils as dba
import utils as ut

"""
This file contains all the appropriate functions for the scheduler.
SECTIONS:
    - Parameters: parameters used for the 
"""

#-------------------------------------------------------------------------------------------------#
# Parameters for the Facebook query
#-------------------------------------------------------------------------------------------------#

# FB Page ID
page = "cocacolacanada" # ["nytimes", "cocacolacanada"] for multipage test

# Scheduler run time max value (in hours)
max_run_time = 24

#-------------------------------------------------------------------------------------------------#
# Scheduler functions
#-------------------------------------------------------------------------------------------------#

def retrieve_data():
    """
    Function to retrieve the data from Facebook and store it into the database.
    INPUT: N/A.
    OUTPUT: Export data to DB.
    """

    print("\n[i] Running scheduled query for page {} at {}.".format(page, ut.get_time()))
    # Instanciating main class for Facebook call
    fbs = FacebookScrapper()

    # Getting hourly data from Facebook
    data = fbs.get_page_fan_count(page=page)

    # Sending data to database
    dba.insert_data_db(data)


#-------------------------------------------------------------------------------------------------#
# Main logic
#-------------------------------------------------------------------------------------------------#

print("[i] FB extraction scheduler is running...")

start = time.time() 
# Execute the function retrieve_data every hour, up to a maximum of max_run_time
schedule.every(1).hour.do(retrieve_data)

# Every 3s for testing purpose:
# schedule.every(3).seconds.do(retrieve_data)

while time.time() - start < (max_run_time * 86400):
    schedule.run_pending()
    time.sleep(60)