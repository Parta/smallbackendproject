** FB_SCRAPER CODE

This repository contains the necessary files for the fb_scraper app to run. It contains the following files:

- app.py: main Flask app (API)
- db_utils.py: file used to communicate with the postgreSQL database using the psycopg2 library.
- fb_scrapper.py: contains the class to fetch data from Facebook
- fb_scrapper_test_shell.py: file to test the extraction, loading and retrieval of data outside the scope of the API.
- scheduler.py: script which start the extraction from FB and db loading process every hour using the schedule library.
- utils.py: contains utils functions
- db_fb_likes: The fb_likes file is a dump of a postgreSQL database used for the test. It is a sample data of the scheduler output at a couple second interval for the purpose of the test. The script however works at every hour in the way the files are set.
- sample_outputs: contains sample outputs of the script for reference.

To restore the dump, use the command: psql fb_likes < db_fb_likes

*** STARTING THE APP 

To start the app, launch the command python run.py.
To start the scheduler, launch the command python scheduler.py.

When both scripts are launched, the API will be served using Flask and the scheduler will populate the Database with new data every hour.

*** QUERYING THE API

To query the API:

	The API has two endpoints:

	- /history : get all the data stored on the db so far
	- /likes_count : get the current count of likes for a given page

	They both accept GET requests with the following parameters:

		- format: the type of format requestesd for the JSON output (possible values: linechart, table, multipage / default = table)
		- page: the Facebook page to request data from (default = cocacolacanada)

	Format for the GET request asked in the test: http://127.0.0.1:5000/[ENDPOINT]?format=[FORMAT]&page=[PAGE]

	GET request samples: 

		/likes_counts: http://127.0.0.1:5000/likes_count?&page=cocacolacanada
		/history: http://127.0.0.1:5000/history?format=multipage&page=cocacolacanada