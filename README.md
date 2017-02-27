 #engagementlabs Back-End Project 

Object:
======================================
PHP 5.6+ application that hourly crawls the evolution of fans of the Facebook Coca-Cola page (https://www.facebook.com/cocacola).  


Functionality:
======================================

A crawling robot is executed by a cron job, crontab.txt, every hour via a command line:  
php index.php --platform=facebook --page_id={fb_page_id}

The API returns a JSON object via a URL such as (but not necessarily) :  
http://localhost/get_data.php?page_id={fb_page_id}&format=linechart 

The API takes a format parameter that changes the structure of the JSON object outputed

It can take one of 3 formats: linechart, table, multiplepage. 

There's json files in this project to show the expected outputs

Data is stored in a MySQL database with one table, fb_data for the Facebook data for any companies followed.
Additional tables could be added to capture data for other social platforms



Answers to questions:
======================================
- Let us imagine we now have 100.000 Facebook pages to get fans count of, every 10 minutes. Please provide a quick answer to the following questions :
    - What would you change in your architecture to cope with the load ?
    - What kind of other possible problems would you think of ?
    - How would you propose to control data quality ?

- Any other comments you might find useful


