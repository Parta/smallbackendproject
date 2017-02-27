 #engagementlabs Back-End Project 

Object:
======================================
PHP 5.6+ application that hourly crawls the evolution of fans of the Facebook Coca-Cola page (https://www.facebook.com/cocacola).  


Functionality:
======================================

A crawling robot is executed by a cron job, crontab.txt, every hour via a command line:  
php index.php --platform=facebook --page_id={fb_page_id}

The API returns a JSON object via a URL:  
http://localhost/get_data.php?page_id={fb_page_id}&format=linechart 

The API takes a format parameter that changes the structure of the JSON object outputed

It can take one of 3 formats: linechart, table, multiplepage. 

There's json files in this project to show the expected outputs

Data is stored in a MySQL database, fansdb, with one table, fb_data for the Facebook data for any companies followed.
Additional tables could be added to capture data for other social platforms



Questions:
======================================
- Let us imagine we now have 100.000 Facebook pages to get fans count of, every 10 minutes. Please provide a quick answer to the following questions :
    - What would you change in your architecture to cope with the load ?
    - What kind of other possible problems would you think of ?
    - How would you propose to control data quality ?

Answers:
======================================
I would keep with one table to hold the Facebook fans data for all the companies. 
100 000 fan_count lookups x 6 times / hour x 24 hours / day ~ (order of magnitude) 10 million rows added / day 
Each month, (order of magnitude) 100 million rows added
Each year, (order of magnitude) a few billion rows added

This is a lot, but it's not straining the limits of a relational database engine like MySQL. That's doable.

At that point it becomes necessary to index the table on the "company", to speed up select queries.

In terms of inserting data into the database, this would be 100 000 inserts every 10 mins, or 167 inserts / second. This gives about 6 ms for each insert to keep up, which is a brisk pace. As the application is set up now, for each company, for each lookup for each company, the application opens a connection to the database, makes an insert, and then closes the database connection. This is going to be a tremendously inefficient way to handle 100 000 lookups in short succession. 

It's going to be a better idea to restructure the method that inserts data into the database to take in an array of [company, fan_count] pairs, open a database connection once, iterate over the array and insert all the data before closing the connection. 

Further, we would want to insert the data in one multi-value bulk insert in one insert statement using multiple sets of values (company1, value1), (company2, value2), ...
We could generate one long SQL insert string programmatically by iterating over the array of [company, fan_count] data pairs.
As long as we don't run into max_allowed_packet limitations, this would work well.

So then we open the connection, generate the sql insert string, perform the one bulk insert, and then close the connection.
This would be the most efficient way I could see to insert the data into the database.

However, I see another problem on the other side, getting the data from Facebook. 600 000 Graph API calls per hour is a lot. This would create issues in terms of time taken to send and receive requests, as well as in rate limits for API calls from Facebook. The time element would in theory be handled by grouping all the requests into one batch, sending that batch, letting it be processed, and then receiving back the response. However, Facebook apparently limits batch size to 50 requests, and all requests still count toward hourly rate limits, which would, as I understand it, be exceeded by this load. I'm not sure how to get around this issue.







