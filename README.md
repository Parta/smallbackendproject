# engagementlabs Back-End Project

Requirements:
======================================
Docker version 17.09.0-ce, build afdb6d4

https://docs.docker.com/engine/installation/#desktop

docker-compose version 1.16.1, build 6d1ac21

https://docs.docker.com/compose/install/#install-compose


Installation:
======================================
In the root of the project directory
```
docker-compose up --build
```

When the services have started, in another terminal run the following command to "ssh" into docker container
```
docker exec -ti smallbackendproject_web_1 bash
```

Run the following command inside the container to startup the application for the first time.
```
root@559a2ac596ef:/parta# python manage.py startup
```

After running the startup, stop the containers by exiting the terminal and run:
```
docker-compose up
```

API:
======================================

```
user: dev
password: a
```

Go to http://localhost:8000/docs

#### /api/fans/linechart/{page_id}

Output JSON list of reports about page in linechart format

Example

http://localhost:8000/api/fans/linechart/cocacolacanada?format=json

#### /api/fans/table/{page_id}

Output JSON list of reports about page in table format

Example

http://localhost:8000/api/fans/table/cocacolacanada?format=json


#### /api/fans/multipage/?&page={page_1}&page{page_2}
Output reports on multiple pages

Example

http://localhost:8000/api/fans/multipage/?&pages=cocacolacanada&pages=pepsi?format=json

#### /api/fans/fans/insertcompany/

Example Curl from Postman
```
curl -X POST \
  http://0.0.0.0:8000/api/fans/put/ \
  -H 'authorization: Basic ZGV2OmE=' \
  -H 'cache-control: no-cache' \
  -H 'content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW' \
  -H 'postman-token: 0895746d-df6c-1f8b-7d9c-5e8310b4059b' \
  -F name=mountaindew
```



Question:
======================================
#### Let us imagine we now have 100.000 Facebook pages to get fans count of, every 10 minutes. Please provide a quick answer to the following questions :

    1) What would you change in your architecture to cope with the load ?

    The application already utilizes an asynchronous task queue, but I would allocate more celery workers increase the performance of the node in the cloud. If we going completely distributed is needed, we would seperate the various docker-compose services. For starters, I would separate the redis database from the docker-compose service and deploy a single instance of the redis db on the cloud node. Workers can then place tasks and process tasks from a single redis db. I would consider changing the model schema and shard the database with the goal of distributing load.

    2) What kind of other possible problems would you think of ?

    If there is also a large number of requests to the api, I would create database indexes and use memcache to optimize the delivery of reports. In order to handle the larger number of database queries, I would use a sharded mongodb database. Moreover, Mongodb's map reduce and filtering is robust to handle queries at webscale.


    3) How would you propose to control data quality ?

    To control data quality, we would need a robust monitoring stack (ELK).
    I would also create ETL tasks that would periodically run on the database to ensure data quality.
    If these tasks have many dependencies, I would use a more sophisticated task/queue technology such as luigi or airflow.



- Any other comments you might find useful

Utilizing Docker will allow us to have environments that are continuous in local and production environments.
It is also relatively simple to add new services (MongoDB, more celery workers).
This allows the application to scale relatively easily.

To add more metrics or different types of social media, I would make additional services similar to facebookservice.py


Evaluation:
======================================

- We will evaluate if the requirements above work as expected

- We will evaluate the structure of the application and the logic behind the separation of concerns. For example in the eventuality of adding other crawlers such as crawling Twitter followers of a Twitter account.

- We will evaluate overall code quality and readability

- We will evaluate the answers to the question listed in the Deliverable section and other comments that you may have found useful

Cheers!