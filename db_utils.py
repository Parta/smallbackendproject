import psycopg2
import sys

from fb_scrapper import FacebookScrapper

"""
This file contains all the appropriate functions for the interface to interact with the database.
"""


###################################################################################################
# Parameters
###################################################################################################

#-------------------------------------------------------------------------------------------------#
# Database parameters
#-------------------------------------------------------------------------------------------------#

DATABASE = "fb_likes"
USER = "Alexandre"

###################################################################################################
# Database functions
###################################################################################################

#-------------------------------------------------------------------------------------------------#
# Errors handling (exceptions)
#-------------------------------------------------------------------------------------------------#

class EmptyDataError(Exception):
    """
    Raise this when Facebook returns a error
    """
    def __init__(self):
        self.args = {"[!!!] No data has been returned from the database. Please check the config."}


#-------------------------------------------------------------------------------------------------#
# Database functions
#-------------------------------------------------------------------------------------------------#

def create_datatable_db():
    """
    Function that creates the initial database.
    INPUT: N/A
    OUTPUT: Datatable on the PostgreSQL db.
    NOTE: Use this function to create/overwrite the table.
    """

    conn = None

    try:
        conn = psycopg2.connect(database=DATABASE, user=USER)   
        cur = conn.cursor()  
        
        # If creating the table is necessary:
        cur.execute("DROP TABLE IF EXISTS Likes")
        cur.execute("CREATE TABLE Likes (Dates INT PRIMARY KEY, Page TEXT, Likes INT)")
        conn.commit()

        print("[i] New table created on db {} by {}.".format(DATABASE, USER))
        
    except psycopg2.DatabaseError as e:
        if conn:
            conn.rollback()
        print ('DB ERROR: {}'.format(e))
    
    finally:
        if conn:
            conn.close()


def insert_data_db(data):
    """
    Function that inserts rows to the database.
    INPUT: data received from Facebook (dictionnary)
    OUTPUT: row in the database
    NOTE: N/A
    """

    data_to_insert = "({0},'{1}',{2})".format(data["data"][0]["date"], 
                                            data["data"][0]["page"], 
                                            data["data"][0]["likes"])

    conn = None

    try:
        conn = psycopg2.connect(database=DATABASE, user=USER)   
        cur = conn.cursor()  
        cur.execute("INSERT INTO Likes VALUES {}".format(data_to_insert))
        conn.commit()
        
    except psycopg2.DatabaseError as e:
        if conn:
            conn.rollback()
        print ('DB ERROR: {}'.format(e))
    
    finally:
        if conn:
            conn.close()

    print("[i] New hourly data (1 row) successfully sent to database {0} by user {1}.".format(DATABASE, USER))


def get_data_db(page):
    """
    Function that loads all the data from the database.
    INPUT: page to look for in db
    OUTPUT: data from DB
    NOTE: N/A
    """

    data = None
    conn = None

    try:
         
        conn = psycopg2.connect(database=DATABASE, user=USER) 
        
        cur = conn.cursor()    
        cur.execute("SELECT * FROM Likes WHERE Page = '{0}'".format(page))
        data = cur.fetchall()
       
    except psycopg2.DatabaseError as e:
        print('DB ERROR: {}'.format(e))
        
    finally:
        if conn:
            conn.close()

    if not data:
        raise EmptyDataError()

    print("[i] {0} rows of data successfully retrieved from database {1} by user {2}.".format(len(data), DATABASE, USER))

    return {"error":False, "data":data}


