This repository contains scripts for
crawling Facebook page likes.
The data is stored in a MongoDB instance
and can be exposed through a service.
You can also specify pages you wish to track.

### Prerequisite

- Python version `>=2.7`
- A running mongodb instance 


### Quick start

- Run `pip install -r requirements.txt` (to install the dependencies) 


### Run

- `cd /path/to/project/dir`
- `export PYTHONPATH='.'`

##### Crawler script:
- `python lib/crawler.py --page_id=<fb_page_id>` for a particular page,
</br> or
- `python lib/crawler.py` for all saved pages.

##### Service:
- `python service/service.py`


### Directory layout

```
.
├── /db/                        # Database operations and model libraries
├── /files/                     # Exported database and service output files in csv/json format
├── /lib/                       # Business logic modules
├── /service/                   # Defines the route (service endpoints)
├── README.md                   # This file
├── requirements.txt            # The list of third party libraries and utilities
```


### Usage

```
$ curl -g -X GET 'http://127.0.0.1:5000/get/fans/?page_id=<fb_page_id>&format=<output_format>'
$ curl -H 'Content-Type: application/json' -X POST -d '{"page_id": "<fb_page_id>"}' http://127.0.0.1:5000/insert/page/
```


### Questions

1. What would you change in your architecture to cope with the load ?
    - I first consider using an API (*Facebook Graph API* in this case)
    rather than crawling web pages in order to speed up the data retrieval process
    - Allocate more resources for data ingestion: most of the services
    can be horizontally scaled on the cloud; for example you can easily
    scale up a deployment (increase the number of pods/containers) through Kubernetes
    - Evenly distribute the load across multiple nodes using parallel
    frameworks such as map-reduce, etc.
2. What kind of other possible problems would you think of ?
    - If using an API, the number of request per minute/hour/day
    or simply API limit/quota
    - A choice of database where data can be easily fetched and/or
    aggreagted under a heavy load
    - Data governance policy (if there are numerous data sources)
    in order to avoid chaos in the future. Apache Falcon and
    Cloudera Navigator are two examples in the Hadoop ecosystem.
3. How would you propose to control data quality ?
    - Develop a real-time monitoring system and precisely keep track
    of what's coming in to the system as well as the data flow.
    One example is to develop a generic monitoring/logging system
    that is capable of generating different types of statistics.
    Then we can use the ELK stack for instance,
    Logstash for log ingestion,
    ElasticSearch for storage and aggregation,
    Kibana for visualization to produce reports and control data quality.
    The other alternative for ELK stack is a combination of
    StatsD, InfluxDB and Grafana.


### Other things I'll consider

- Add unit tests or develop the project in a TDD style manner (tests first)
- Define API contracts using Swagger (flask-swagger or other libraries) for easy data validation, documentation and user manuals
- Create proper indices over collections/tables for faster data retrieval
- Possibly persist the data to tools such as ElasticSearch (or similar tools for that matter) to be able to query fast and visualize the data
