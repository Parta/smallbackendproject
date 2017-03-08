 #engagementlabs Back-End Project 

Object:
======================================
Create a PHP 5.6+ application that hourly crawls the evolution of fans of the Facebook Coca-Cola page (https://www.facebook.com/cocacola).  
Answer some questions on how to make thi system scale (see Deliverable section.)


Rules:
======================================

(In the text below, {fb_page_id} = "cocacola")
- Create database using script
`database\migration.sql`
- The crawling robot must be executed by a cron job every hour via a command line such as (but not necessarily) :  
`php fanCountCrawler.php --uri=crawler/fans --page_id={fb_page_id}`

- The API should return a JSON object via a URL such as (but not necessarily) :  
`http://localhost/smallbackendproject/get/fans?page_id={fb_page_id}&format=linechart `
