 #engagementlabs Back-End Project 

Object:
======================================
Create a PHP 5.6+ application that hourly crawls the evolution of fans of the Facebook Coca-Cola page (https://www.facebook.com/cocacola).  
Answer some questions on how to make this system scale (see Deliverable section.)


How does it work?:
======================================

(In the text below, {fb_page_id} = "cocacola")

- The Crawling Bot:  
	php index.php --crawl-for=fb_fans --page-id={page_id}

- The API:  
	e.g http://localhost:5255/fans.php?page_id=pepsi&format=table

- Database technology, data structure and application architecture
	1. Plain PHP
	2. sql/* has the DDL
	3. This app uses a single MySQL table to store historic fan counts.


Answers:
======================================
- Let us imagine we now have 100.000 Facebook pages to get fans count of, every 10 minutes. Please provide a quick answer to the following questions :
    - What would you change in your architecture to cope with the load ?
    	1. Move away historic data to a different storage than the same MySQL table the crawler uses to store recent fan counts.
    	2. As this data is not updated, it can be cached and served from a CDN location for specific periods.
    	3. As the data collection evolves, various important points in a day could be identified and daily/hourly averages can be used to create periodic evolution charts.

    - What kind of other possible problems would you think of ?
    	1. API Rate Limits: FB API won't like it for sure! I can't think of a solution to address this except spreading this task around multiple servers. Especially, if these calls have to be initiated every 10 minutes for all of the 100k pages.

    	2. No data getting saved due to api/network/database error.

    - How would you propose to control data quality ?

- Any other comments you might find useful