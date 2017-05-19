import time
import datetime

import pandas as pd
import json

"""
This file contains all the appropriate futils function to support the API. 

SECTIONS: 
    - Data wrangling functions: support for data formatting.
    - App Helper functions: support for the Flask application.
    - Utils functions: basic functions used across the project.
NOTES:
    N/A
"""

#-------------------------------------------------------------------------------------------------#
# Data wrangling functions
#-------------------------------------------------------------------------------------------------#

def assemble_response(data_returned, output="table"):
    """
    Function that formats the response depending on the output selected.
    INPUT: data from db, output type.
    OUTPUT: JSON for API results.
    """

    data_dict = {"error":data_returned["error"], "data":data_returned["data"]}    

    if output == "table":
        data_table = {}
        for elt in data_dict["data"]:
            data_table[elt[0]] = str(elt[2])
        data_dict["data"] = data_table

        return json.dumps(data_dict)
    

    elif output == "linechart":
        data_linechart = {}
        data_linechart["error"] = data_dict["error"]
        data_linechart["data"] = []

        for elt in data_dict["data"]:
            data_linechart["data"].append({"date":elt[0], "likes": elt[2]})

        return json.dumps(data_linechart)
        

    elif output == "multipage":
        pages = {}
        pages["error"] = data_dict["error"]
        pages["data"] = {}

        data_df = pd.DataFrame([{"date":elt[0], "page":elt[1], "likes": elt[2]} for elt in data_dict["data"]])
        data_df["date"] = data_df["date"].astype(str)
        data_df["likes"] = data_df["likes"].astype(str)

        for unique_pages in set(data_df["page"]):
            df = data_df[data_df["page"] == unique_pages][["date", "likes"]].to_dict(orient="records")
            pages["data"].update({unique_pages: df})

        return json.dumps(pages)


#-------------------------------------------------------------------------------------------------#
# App helper functions
#-------------------------------------------------------------------------------------------------#

def get_default_params(params):
    """
    This function gets the defaults params in case nothing is received from the GET request.
    """

    if params is not None:
        # Default values for values of parameters if not sent by the GET request    
        output = params["format"][0] if "format" in params else "table"
        page = params["page"][0] if "page" in params else "cocacolacanada"
    else:
        output = "table"
        page = "cocacolacanada"

    return output, page

#-------------------------------------------------------------------------------------------------#
# Utils functions
#-------------------------------------------------------------------------------------------------#

def get_time(time_type=""):
    """
    Function that returns the current time.
    INPUT: N/A
    OUTPUT: Date and hour (str)
    """

    if time_type == "timestamp":
        return str(time.time()).split('.')[0]
    else:
        return datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S")