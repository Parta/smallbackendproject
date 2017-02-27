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

There are json files in this project (linechart, table, multiplepage) to show examples of the expected output

Data is stored in a MySQL database, fansdb, with one table, fb_data for the Facebook data for any companies followed. This table has 3 rows - company, date, value - and is indexed on company.
Additional tables could be added to capture data for other social platforms

Contents:
=====================================
* index.php - script to crawl Facebook and enter data into DB
* getdata.php - script to retrieve company data from database requested using URL
* config.php - basic config data used by scripts
* crontab.txt - cron script to execute hourly to call index.php
* fansdb.sql - export of database structure

Questions:
======================================
- Let us imagine we now have 100.000 Facebook pages to get fans count of, every 10 minutes. Please provide a quick answer to the following questions :
    - What would you change in your architecture to cope with the load ?
    - What kind of other possible problems would you think of ?
    - How would you propose to control data quality ?

Answers:
======================================
__Coping with Increased Load__

I would keep with one table to hold the Facebook fans data for all the companies. 
100 000 fan_count lookups x 6 times / hour x 24 hours / day ~ (order of magnitude) 10 million rows added / day 
Each month, (order of magnitude) 100 million rows added
Each year, (order of magnitude) a few billion rows added

This is a lot, but it's not straining the limits of a relational database engine like MySQL. That's doable.

At that point it becomes necessary to index the table on the "company", to speed up select queries.

In terms of inserting data into the database, this would be 100 000 inserts every 10 mins, or 167 inserts / second. This gives about 6 ms for each insert to keep up, which is a brisk pace. As the application is set up now, for each lookup for each company, the application opens a connection to the database, makes an insert, and then closes the database connection. This is going to be a tremendously inefficient way to handle 100 000 lookups in short succession. 

It's going to be a better idea to restructure the method that inserts data into the database to take in an array of [company, fan_count] pairs, open a database connection once, iterate over the array and insert all the data before closing the connection. 

Further, we would want to insert the data in ONE multi-value bulk insert in ONE insert statement using multiple sets of values (company1, value1), (company2, value2), ...
We could generate one long SQL insert string programmatically by iterating over the array of [company, fan_count] data pairs.
As long as we don't run into max_allowed_packet limitations, this would work well.
http://stackoverflow.com/questions/22164070/mysql-insert-20k-rows-in-single-insert

So then we open the connection, generate the sql insert string, perform the one bulk insert, and then close the connection.
This would be the most efficient way I could see to insert the data into the database.


__Other Problems__

However, I see another problem on the other side, getting the data from Facebook. 600 000 Graph API calls per hour is a lot. This would create issues in terms of time taken to send and receive requests, as well as in rate limits for API calls from Facebook. The time element would in theory be handled by grouping all the requests into one batch, sending that batch, letting it be processed, and then receiving back the response. However, Facebook apparently limits batch size to 50 requests, and all requests still count toward hourly rate limits, which would, as I understand it, be exceeded by this load. I'm not sure how to get around this issue.


__Data Quality Considerations__

Three data quality issues that could present themselves are:
* missing data
* out of bounds data values, and 
* outliers.

Out of bounds data would be values that due to errors are outside the realistic range - for example, a negative value for a Facebook fan_count. Out of bounds or missing values could be addressed on insertion into the database, and could be replaced by some chosen indicator - NULL, say.

The data can also be periodically examined and cleaned after the fact. This is where outliers can be more easily identified. Outliers could include values that jump from one measurement period to another by an excessive amount - for example, you wouldn't generally expect the CocaCola fans count to jump by 10% in 10 minutes. Data that varies beyond some threashold relative to its nearest neighbors in the time series could be either dropped - whether from the database or from the analysis process - or adjusted via interpolation - again, either in the database or in the process of analysis. NULL values could be treated after the fact in the same way. 

We would also probably want to perform some sort of statistical smoothing of the time series to help separate signal from noise to improve the ability to perform modeling of the data. You're going to want to be able to model to properly attribute variation in stats to whatever marketing intervention you're making to evaluate effectiveness.





