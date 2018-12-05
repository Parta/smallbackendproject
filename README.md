 #engagementlabs Back-End Project 


Object :
======================================
The objective of this project is to create a 2-page platform allowing to display a linechart data visualization. The data feeding this chart will come from Engagement Labs' TotalSocial API.
The 2 pages are :
- a login screen, which after successful login will redirect you to :
- a simple page displaying a data visualisation (linechart)

Description:
======================================
Backend :
- Use the API from EngagementLabs to get a timeseries (offline volume score metric) of the US brands 7UP and A&W Root Beer, during the period of September 2018, using a weekly interval. (see Resources section below)
- All data needs to be saved to a database of your choice.
- Create a login endpoint for your platform (effectively creating a session, but using the TotalSocial API credentials).
- Create endpoint(s) so the front end can fetch Brands data from your database.

Frontend:
- The application will need to be made with a Backbone framework.
We require the creation of 2 pages
- A login page
- A page to display or graph using D3.js library
(more details will follow)

Resources :
======================================
Login token : https://api.engagementlabs.com/oauth/v2/token

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

- Endpoint(s) need to return json.

Frontend:

Highest Priority:
- The markup for the login should be displayed in a layout view’s region

- We would really like to see a routing and navigation system
  (This goes to say that the url displayed should change as well and
   If already logged in, we should be able to navigate to the graph using the url that was displayed)
   
- On a successful login, your application should trigger the controller in charge of displaying your graph

- The view for your graph should replace the login view in the layout view’s region

- A working logout button (we leave the method up to you), redirecting you to login page.

We will not ask you to make a specific type of graph.

Low priority:
Login will need the following validation

Password:
At least 5 characters
At most 10 characters
Must contain at least one uppercase letter and one number
Cannot be blank


Deliverable:
======================================
- Fork this project

- Push to your forked repository, containing your PHP and JS files, cron file, an export of your database

- In your repository wiki, answer the questions and put any additionnal informations

- Create a pull request to submit your project.

- Make sure your repository is publicly accessible

Frontend:

- A login page with a basic validation of username and password

- A successful login will navigate us to another page.

- This page will display the data given to us by the endpoint using a 

- Graph you will code using the d3.js library.

- A working logout button.


Evaluation:
======================================

- We will evaluate if the requirements above work as expected.

- We will evaluate the structure of the application and the logic behind the separation of concerns.

- We will evaluate overall code quality and readability.

- We will evaluate communication on Slack and on TargetProcess. Feel free to ask any question or communicate about any blocker.

- There will be a code review at the end of the process.
