 #engagementlabs Back-End Project 

Object:
======================================
Create a PHP 7.0+ application that pulls the evolution of the Apple Watch and Fitbit during the period of september 2018.  
Answer some questions on how to make this system scale (see Deliverable section.)

Rules:
======================================

- You must be able to login to the api by using this credentials :

Endpoint : https://evapro-ui-production.engagementlabs.com/api/v3.0.1/getToken

Username:

Password:

Result Expected : Api result by giving a token

- call the api to get the general info for the Apple Watch and Fitbit

Endpoint : https://evapro-ui-production.engagementlabs.com/api/v3.0.1/search

This endpoint is only available if you have the right token:

{Authorization: Bearer {token}}

- Save those infos on your database

- Send a request to the api to get the score for each brand and make them possible to sort by week or month

Endpoint : https://evapro-ui-production.engagementlabs.com/api/v3.0.1/items?ids={id,id}&metrics=offline.scoreVolume.value%2Coffline.scoreInfluence.value%2Coffline.scoreBrandSharing.value%2Coffline.scoreSentiment.value&output_type=overtime&from={timesptamp}&to={timesptamp}&interval={interval}
This endpoint is only available if you have the right token

{Authorization: Bearer {token}}

- Save those infos on your database

- Create an endpoint to have get access of the score data.

- Database technology, data structure and application architecture is up to you but you need to use Symfony and the library FriendsOfSymfony (https://github.com/FriendsOfSymfony)



Deliverable:
======================================
- Fork this project

- Push to your forked repository, containing your PHP files, cron file, an export of your database

- In your repository wiki, answer the questions and put any additionnal informations

- Create a pull request to submit your project.

- Make sure your repository is publicly accessible

Question:
======================================
- Can you please justify your choice about the database, the data structure and application?

- If you don't have to use the library FriendsOfSymfony or even Symfony, Which framework/library you will use to make the test and why?


Evaluation:
======================================

- We will evaluate if the requirements above work as expected

- We will evaluate the structure of the application and the logic behind the separation of concerns. For example in the eventuality of adding other crawlers such as crawling Twitter followers of a Twitter account.

- We will evaluate overall code quality and readability

- We will evaluate the answers to the question listed in the Deliverable section and other comments that you may have found useful



Cheers!
