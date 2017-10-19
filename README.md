Overview:
======================================
This project has the purpose to retreive data from web page and push the data into database (Firebase)

The project is composed with two part: crawler and api
- The crawler get the data and push it into the databse. The code is located into <src> directory.
- The api get the data from the database and display it using a specific format. the api is an app inside a Django project inside <parta_site> directory.

Installation:
======================================
The project use Firebase as realtime database. Please create a database by following this link:
https://console.firebase.google.com/

Inside <config> directory, copy the file <example.config.yaml> and rename it to config.yaml. Put your credentials in the corresponding field

For security reason you have to define an Email/Password authentification for your database. Use this link where {your_database_id} is the database identifier for your database
https://console.firebase.google.com/project/{your_database_id}/authentication/users

I recommand to instal pip and virtualenv (mkvirualenv on windos plateforme)

The Crawler
======================================
To install the project run the command:
pip install -r requirements.txt requirements.dev.txt

To populate the database for pepsi 'facebook page run the command:

python src/crawler.py --uri=crawler/fans_count --page_id=pepsi --plateforme=facebook

You can see the data structure by viewing the image <data/database-structure.png> 

The api
======================================
A django web site was created for this purpose. The root directory is <parta_site>

The code for my simple api is located on <parta_site/crawler_api/views.py>

To get the json structure
http://127.0.0.1:8000/crawler/get/?uri=fans_count&page_id={page_id}&plateforme=facebook&format=multiplepage

Here the accepted parameters:
- The format accepted is: multipage, table, linechart
- The only uri processed is fans_count
- The plateforme supported is facebook


Question:
======================================
- Let us imagine we now have 100.000 Facebook pages to get fans count of, every 10 minutes. Please provide a quick answer to the following questions :
    - What would you change in your architecture to cope with the load ?
    It ll good idea to install a queue system and add more servers. Each server  will run a bunch of queries. If we are limited on servers using Nodejs can be an alternative.

    - What kind of other possible problems would you think of ?
    The page structure changes can break the app. Also if the server run on Italy for example, Facebook will return a localized page for the given page. Then the parser will never  find the reruired data

    - How would you propose to control data quality ?
    Verify the structure of the page. Add try catch and logging. Figure out all possible server variables that can affect the programm and fix them


Comments:
======================================
For the readability I didn't any any comment but I pay more attentionon the crawler module (<src/parta>) interacting with Firebase.
Why I used Python? It was an opportunity to refresh my knowledges.
Why django? To learn new framework
Why Firebase? No headache with database. Realtime database. Free and available worldwide.

Thank you for your time and for this opportunity to deal with a real world problem!