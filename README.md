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

To install the project run the command:
pip install -r requirements.txt requirements.dev.txt

To populate the database for pepsi 'facebook page run the command:

python src/crawler.py --uri=crawler/fans_count --page_id=pepsi --plateforme=facebook

You can see the data structure by viewing the image <data/database-structure.png> 

The api

A django web site was created for this purpose. The root directory is <parta_site>
