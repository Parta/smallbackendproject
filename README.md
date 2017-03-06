 #engagementlabs Back-End Project 

Object:
======================================
Create a PHP 5.6+ application that hourly crawls the evolution of fans of the Facebook Coca-Cola page (https://www.facebook.com/cocacola).  
Answer some questions on how to make this system scale (see Deliverable section.)


Rules:
======================================

(In the text below, {fb_page_id} = "cocacola")

- The crawling robot must be executed by a cron job every hour via a command line such as (but not necessarily) :  
php index.php --uri=crawler/fans --page_id={fb_page_id}

- The API should return a JSON object via a URL such as (but not necessarily) :  
http://localhost/myframework/get/fans?page_id={fb_page_id}&format=linechart 

- The API should be able to take a format parameter that change the structure of the JSON object outputed

- There will be 3 format: linechart, table, multiplepage. There's json files in this project to show the expected outputs

- Database technology, data structure and application architecture is up to you.



Deliverable:
======================================
- Fork this project

- Push to your forked repository, containing your PHP files, cron file, an export of your database

- In your repository wiki, answer the questions and put any additionnal informations

- Create a pull request to submit your project.

- Make sure your repository is publicly accessible

Question:
======================================
- Let us imagine we now have 100.000 Facebook pages to get fans count of, every 10 minutes. Please provide a quick answer to the following questions :
    - What would you change in your architecture to cope with the load ?
    	1. 

    - What kind of other possible problems would you think of ?
    - How would you propose to control data quality ?

- Any other comments you might find useful


Evaluation:
======================================

- We will evaluate if the requirements above work as expected

- We will evaluate the structure of the application and the logic behind the separation of concerns. For example in the eventuality of adding other crawlers such as crawling Twitter followers of a Twitter account.

- We will evaluate overall code quality and readability

- We will evaluate the answers to the question listed in the Deliverable section and other comments that you may have found useful



Cheers!
