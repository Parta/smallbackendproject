 #engagementlabs Back-End Project 


Global Object:
======================================
The objective of this project is to create a platform to see a linechart data visualization of the US brands "7UP" and "A&W Root Beer" during the period of september 2018 and on a weekly interval.
It require you to login with valid credential and after a successful login, you will redirect to the linechart page.

Object:
======================================
Backend :
- Use the API from EngagementLabs to get the data of the US brands 7UP and A&W Root Beer. (see Resources section bellow)
- All data needs to be save on your database.
- Create a login endpoint for your platform.
- create endpoint(s) to get the Brands data.

Frontend:
- The application will need to be made with a Backbone framework.
We require the creation of 2 pages
- A login page
- A page to display or graph
(more details will follow)

Resources :
======================================
Login token : https://api.engagementlabs.com/oauth/v2/token

- Credential :

- grant_type: client_credentials

- client_id: 4_458qvdwmkiec008o8c4s8swwkw44ck4k4g0wsk0cwg4ooggc08

- client_secret: 149bbor69msgooss484wsskws40ow8os84swgcwo8ssc0gowog

- Expect Results : see login_exemple.json

items List : https://api.engagementlabs.com/oauth/v2/search 

- The endpoint need a valid token to be accessible:
- Header exemple: {Authorization: Bearer {token}}
- Expect Results : see item_list_exemple.json

list of metrics value by brand ids : https://api.engagementlabs.com/oauth/v2/items?ids={id,id}&metrics=offline.scoreVolume.value&output_type=overtime&from={timesptamp}&to={timesptamp}&interval={interval}
- Internal value could be week or month. 
- The endpoint need a valid token to be accessible:
- Header exemple: {Authorization: Bearer {token}}
- Expect Results : see overtime_exemple.json

Rules:
======================================
Back-end :

- Database technology, data structure and application architecture is up to you but you need to use Symfony and the library FriendsOfSymfony (https://github.com/FriendsOfSymfony)

- Endpoint(s) need to return a json.

Frontend:

Highest Priority:
- The markup for the login should be displayed in a layout view’s region

- We would really like to see a routing and navigation system
  (This goes to say that the url displayed should change as well and
   If already logged in, we should be able to navigate to the graph using the url that was displayed)
   
- On a successful login, your application should trigger the controller in charge of displaying your graph

- The view for your graph should replace the login view in the layout view’s region

- A working logout button.(we leave the method up to you)

We will not ask you to make a specific type of graph.

Low priority:
Login will need the following validation

Email:
Must be a valid email
Cannot be blank

Password:
At least 5 characters
At most 10 characters
Must contain at least one uppercase letter and one number
Cannot be blank


Deliverable:
======================================
- Fork this project

- Push to your forked repository, containing your PHP files, cron file, an export of your database

- In your repository wiki, answer the questions and put any additionnal informations

- Create a pull request to submit your project.

- Make sure your repository is publicly accessible

Frontend:
- A login page with a basic validation of email and password

- A successful login will navigate us to another page.

- This page will display the data given to us by the endpoint using a 

- graph you will code using the d3.js library.


- A working logout button.

Question:
======================================
- Can you please justify your choice about the database, the data structure and application?

- If you don't have to use the library FriendsOfSymfony or even Symfony, Which framework/library you will use to make the test and why?

Frontend:
- Explain the reason behind your choice of graph

- Explain your method for validating input fields for the login

Evaluation:
======================================

- We will evaluate if the requirements above work as expected

- We will evaluate the structure of the application and the logic behind the separation of concerns. For example in the eventuality of adding other crawlers such as crawling Twitter followers of a Twitter account.

- We will evaluate overall code quality and readability

- We will evaluate the answers to the question listed in the Deliverable section and other comments that you may have found useful


Frontend:
- Structuring of modules, use of navigation system, views and templates

- We will ask that the graph be flexible for many screen sizes

- Bonus points :
- if you use the backbone validation plugin
- if the graph is flexible for a different day format (weekly and monthly interval)


Cheers!
