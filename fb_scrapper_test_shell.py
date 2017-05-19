import pandas as pd
import numpy as np

from fb_scrapper import FacebookScrapper
import db_utils as dba
import utils as ut

"""
This file is used to test the addition and retrieval of the data outside the scope of the API app.

It does the following:

1. Instanciate the FacebookScraper Class
2. Get the data from the FB GraphAPI
3. Insert the entry into the PostGreSQL db
4. Extract the data from the PostGreSQL db
5. Get the output from the assemble_response function and prints it
"""

#-------------------------------------------------------------------------------------------------#
# Parameters for the Facebook query
#-------------------------------------------------------------------------------------------------#

# FB Page ID
page = "cocacolacanada" # ["nytimes", "cocacolacanada"] for multipage test

output_format = "multipage"

###################################################################################################
# Test
###################################################################################################

# Instanciating main class for Facebook call
fbs = FacebookScrapper()

# Getting hourly data from Facebook
data = fbs.get_page_fan_count(page=page)

# Sending data to database
dba.insert_data_db(data)

# Retrieving data from database
stored_data = dba.get_data_db(page=page)

# Formmating data output
output = ut.assemble_response(data_returned=stored_data, output=output_format)

# Preview output
print(output)