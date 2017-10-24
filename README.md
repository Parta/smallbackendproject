Questions
=========
- The only change to crawl 100 000 Facebook pages would be adding a loop to $path_to_project$\app\Console\Kernel.php
schedule function (see already existing logic). I added 3 different pages. Scheduled jobs are easy configurable - to set the schedule to every 10 minutes all you need to do is change 'hourly' to 'everyTenMinutes':

        $schedule->command('crawler:hour cocacola')
             ->everyTenMinutes();

- Some of the problems could be:
  - the amount off curl request to the Facebook page and the server power to handle it
  - possible deadlocks while writing results (to many writes - in case of relative DBs)
  - blocked FB application account due to too many API requests.
  
- Data quality control
  - Store results in different tables in case when crawling thousands of pages spliting by additional filter
  - Add additional domain servers in order to handle the amount of data (DB servers and Apache/Nginx servers)
  - Use-case tests to test code quality 
- Other:
  - Implement API authorization
  - Add caching to ease off DB load
  - Add queue system for scheduled jobs
  - Allow multiple command instances and cron job locking to avoid duplications
 

Command
=======
Crontab command:
---------------
 - \* \* \* \* \* php $path_to_project$/artisan schedule:run
 Add this command to your crontab and preceding by five stars.
 This will run the Kernel.php schedule function and all specified cron jobs

Cron command:
-------------
 - php artisan crawler:hourly {page_name}
 This command allows to run cron job manually from command line.
 You need to be in the project folder.
 
 API
 ===
 Access API
 ----------
  URL: {domain}/api/fans
  
  Additional GET parameters: (returned in the API response under "filters")
    - output (csv/json) if csv applied the rest of the filters are not applicable/ignored
    - format (multipage/table/linechart) default is multipage
    - page_name (facebook page id) - cocacola/apple/intel available in DB
    - limit - number of results per page (in case of multipage - total number of mixed results)
    - offset - works only if limit applied
 
Examples:
---------
    
  Request:
  --------
   - http://smallbackendproject/api/fans?format=table&limit=20&offset=500 
  
  Response
  -------- 
 ```json
{
   "error": false,
   "filters": {
      "output": {
         "description": "Output type",
         "default": "json",
         "available_values": [
            "json",
            "csv"
         ]
      },
      "format": {
         "description": "Output data structure (available for [json] output only)",
         "default": "multipage",
         "available_values": [
            "table",
            "linechart",
            "multipage"
         ]
      },
      "page_name": {
         "description": "Facebook company page name (page ID)",
         "default": "all",
         "available_values": [
            "all",
            "cocacola",
            "apple",
            "intel"
         ]
      },
      "limit": {
         "description": "Number of results per page",
         "default": 0
      },
      "offset": {
         "description": "Results offset (works if [limit] parameter is passed",
         "default": 0
      }
   },
   "data": {
      "intel": {
         "1508109601": 38774250,
         "1508109662": 38774246,
         "1508109721": 38774248,
         "1508109782": 38774246,
         "1508109841": 38774245,
         "1508109902": 38774245,
         "1508109961": 38774241
      },
      "apple": {
         "1508109602": 8531919,
         "1508109663": 8531919,
         "1508109722": 8531919,
         "1508109783": 8531923,
         "1508109842": 8531928,
         "1508109902": 8531928,
         "1508109962": 8531931
      },
      "cocacola": {
         "1508109661": 106033146,
         "1508109721": 106033146,
         "1508109781": 106033150,
         "1508109841": 106033144,
         "1508109901": 106033150,
         "1508109961": 106033147
      }
   }
}
```
         

 Request:
 --------
   - http://smallbackendproject/api/fans?format=linechart&limit=20&offset=500 
  
  Response:
  --------- 
```json
 {
    "error": false,
    "filters": {
       "output": {
          "description": "Output type",
          "default": "json",
          "available_values": [
             "json",
             "csv"
          ]
       },
       "format": {
          "description": "Output data structure (available for [json] output only)",
          "default": "multipage",
          "available_values": [
             "table",
             "linechart",
             "multipage"
          ]
       },
       "page_name": {
          "description": "Facebook company page name (page ID)",
          "default": "all",
          "available_values": [
             "all",
             "cocacola",
             "apple",
             "intel"
          ]
       },
       "limit": {
          "description": "Number of results per page",
          "default": 0
       },
       "offset": {
          "description": "Results offset (works if [limit] parameter is passed",
          "default": 0
       }
    },
    "data": {
       "intel": [
          {
             "date": "2017-10-15 23:20:01",
             "value": 38774250
          },
          {
             "date": "2017-10-15 23:21:02",
             "value": 38774246
          },
          {
             "date": "2017-10-15 23:22:01",
             "value": 38774248
          },
          {
             "date": "2017-10-15 23:23:02",
             "value": 38774246
          },
          {
             "date": "2017-10-15 23:24:01",
             "value": 38774245
          },
          {
             "date": "2017-10-15 23:25:02",
             "value": 38774245
          },
          {
             "date": "2017-10-15 23:26:01",
             "value": 38774241
          }
       ],
       "apple": [
          {
             "date": "2017-10-15 23:20:02",
             "value": 8531919
          },
          {
             "date": "2017-10-15 23:21:03",
             "value": 8531919
          },
          {
             "date": "2017-10-15 23:22:02",
             "value": 8531919
          },
          {
             "date": "2017-10-15 23:23:03",
             "value": 8531923
          },
          {
             "date": "2017-10-15 23:24:02",
             "value": 8531928
          },
          {
             "date": "2017-10-15 23:25:02",
             "value": 8531928
          },
          {
             "date": "2017-10-15 23:26:02",
             "value": 8531931
          }
       ],
       "cocacola": [
          {
             "date": "2017-10-15 23:21:01",
             "value": 106033146
          },
          {
             "date": "2017-10-15 23:22:01",
             "value": 106033146
          },
          {
             "date": "2017-10-15 23:23:01",
             "value": 106033150
          },
          {
             "date": "2017-10-15 23:24:01",
             "value": 106033144
          },
          {
             "date": "2017-10-15 23:25:01",
             "value": 106033150
          },
          {
             "date": "2017-10-15 23:26:01",
             "value": 106033147
          }
       ]
    }
 }
```
  
  Request:
  --------
  
   - http://smallbackendproject/api/fans?format=multipage&limit=20&offset=500
   
   Response:
   ---------
   
```json
{
   "error": false,
   "filters": {
      "output": {
         "description": "Output type",
         "default": "json",
         "available_values": [
            "json",
            "csv"
         ]
      },
      "format": {
         "description": "Output data structure (available for [json] output only)",
         "default": "multipage",
         "available_values": [
            "table",
            "linechart",
            "multipage"
         ]
      },
      "page_name": {
         "description": "Facebook company page name (page ID)",
         "default": "all",
         "available_values": [
            "all",
            "cocacola",
            "apple",
            "intel"
         ]
      },
      "limit": {
         "description": "Number of results per page",
         "default": 0
      },
      "offset": {
         "description": "Results offset (works if [limit] parameter is passed",
         "default": 0
      }
   },
   "data": {
      "intel": [
         {
            "page_id": 22707976849,
            "page": "intel",
            "name": "Intel",
            "count": 38774250,
            "request_time": "2017-10-15 23:20:01"
         },
         {
            "page_id": 22707976849,
            "page": "intel",
            "name": "Intel",
            "count": 38774246,
            "request_time": "2017-10-15 23:21:02"
         },
         {
            "page_id": 22707976849,
            "page": "intel",
            "name": "Intel",
            "count": 38774248,
            "request_time": "2017-10-15 23:22:01"
         },
         {
            "page_id": 22707976849,
            "page": "intel",
            "name": "Intel",
            "count": 38774246,
            "request_time": "2017-10-15 23:23:02"
         },
         {
            "page_id": 22707976849,
            "page": "intel",
            "name": "Intel",
            "count": 38774245,
            "request_time": "2017-10-15 23:24:01"
         },
         {
            "page_id": 22707976849,
            "page": "intel",
            "name": "Intel",
            "count": 38774245,
            "request_time": "2017-10-15 23:25:02"
         },
         {
            "page_id": 22707976849,
            "page": "intel",
            "name": "Intel",
            "count": 38774241,
            "request_time": "2017-10-15 23:26:01"
         }
      ],
      "apple": [
         {
            "page_id": 434174436675167,
            "page": "apple",
            "name": "Apple",
            "count": 8531919,
            "request_time": "2017-10-15 23:20:02"
         },
         {
            "page_id": 434174436675167,
            "page": "apple",
            "name": "Apple",
            "count": 8531919,
            "request_time": "2017-10-15 23:21:03"
         },
         {
            "page_id": 434174436675167,
            "page": "apple",
            "name": "Apple",
            "count": 8531919,
            "request_time": "2017-10-15 23:22:02"
         },
         {
            "page_id": 434174436675167,
            "page": "apple",
            "name": "Apple",
            "count": 8531923,
            "request_time": "2017-10-15 23:23:03"
         },
         {
            "page_id": 434174436675167,
            "page": "apple",
            "name": "Apple",
            "count": 8531928,
            "request_time": "2017-10-15 23:24:02"
         },
         {
            "page_id": 434174436675167,
            "page": "apple",
            "name": "Apple",
            "count": 8531928,
            "request_time": "2017-10-15 23:25:02"
         },
         {
            "page_id": 434174436675167,
            "page": "apple",
            "name": "Apple",
            "count": 8531931,
            "request_time": "2017-10-15 23:26:02"
         }
      ],
      "cocacola": [
         {
            "page_id": 40796308305,
            "page": "cocacola",
            "name": "Coca-Cola",
            "count": 106033146,
            "request_time": "2017-10-15 23:21:01"
         },
         {
            "page_id": 40796308305,
            "page": "cocacola",
            "name": "Coca-Cola",
            "count": 106033146,
            "request_time": "2017-10-15 23:22:01"
         },
         {
            "page_id": 40796308305,
            "page": "cocacola",
            "name": "Coca-Cola",
            "count": 106033150,
            "request_time": "2017-10-15 23:23:01"
         },
         {
            "page_id": 40796308305,
            "page": "cocacola",
            "name": "Coca-Cola",
            "count": 106033144,
            "request_time": "2017-10-15 23:24:01"
         },
         {
            "page_id": 40796308305,
            "page": "cocacola",
            "name": "Coca-Cola",
            "count": 106033150,
            "request_time": "2017-10-15 23:25:01"
         },
         {
            "page_id": 40796308305,
            "page": "cocacola",
            "name": "Coca-Cola",
            "count": 106033147,
            "request_time": "2017-10-15 23:26:01"
         }
      ]
   }
}
```

Database table is in the fans_likes.sql file in the project root
------------
  
 