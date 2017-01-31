 #engagementlabs Back-End Project

Object:
======================================
Create a PHP 5.6+ application that hourly crawls the evolution of fans of the Facebook Coca-Cola page (https://www.facebook.com/cocacola).
Answer some questions on how to make this system scale (see Deliverable section.)


Deliverable:
======================================
- In cronjob.py add "!#/path/to/your/python"

- In crontab -e : add "0 * * * * /path/to/cronjob.py cocacola" The python script takes as argument any facebook page. This will run the script every hour which will save to database. Make sure you have permissions on cronjob.py i.e. chmod a+x

- Run "python api.py" to have your server running

- Api address is /api/<page_name>/fancount/<format>

- Database used is SQLite to save hassle of server setup

- Flask is used for simple and easy REST api creation

Question:
======================================
- Let us imagine we now have 100.000 Facebook pages to get fans count of, every 10 minutes. Please provide a quick answer to the following questions :
    - What would you change in your architecture to cope with the load ?
    I would have parallel jobs running to fetch the data asynchronously
    - What kind of other possible problems would you think of ?
    We could run into severe database memory/storage issues. Depending on the size of each row and the data types we use 100,000 rows every 10 mins will lead to an extreme amount of data in a short period of time. If we are also indexing this will further increase storage problems.
    - How would you propose to control data quality ?
    Make sure are database changes are made within a transaction. Ensure locks are aquired when writing to database.

- Any other comments you might find useful
Very enjoyable exercise.
