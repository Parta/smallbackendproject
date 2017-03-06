<?php

/**
 * Helpers
 */

//
// Command Line
//

/**
 * Parse CLI input and arrange them into key+value pairs
 */
function parse_cli($argv)
{
    $parsed_cli = [];
    $cli_params = array_slice($argv, 1);

    foreach ($cli_params as $param) {

        // Valid inputs begin with --
        if ($param[0] === '-' && $param[1] === '-') {
            $tmp = explode('=', $param, 2);
            $parsed_cli[substr($tmp[0], 2)] = $tmp[1];
        }
    }

    return $parsed_cli;
}

//
// Service Providers
//
/**
 * Fetch latest FB fancount for a given page
 */
function fb_fetch_fancount($page)
{
    // Assuming response is always a well-formatted json
    $json = json_decode(file_get_contents(fb_get_page_url($page, ['fan_count'])));

    return $json->fan_count;
}

/**
 * Build a URL to fetch given fiedls
 */
function fb_get_page_url($page, $fields=[])
{
    return config("facebook.api_endpoint")
            . $page . "?fields=" . implode(",", $fields) . "&access_token="
            . config("facebook.access_token");
}


//
// Database
//

/**
 * Create new Database Connection
 */
function db_get_connection()
{
    $db_con = new mysqli(
            config("database.host"),
            config("database.username"),
            config("database.password"),
            config("database.database")
        );

    if ($db_con->connect_errno) {
        die("Database Error. #" . $db_con->connect_errno . ": " . $db_con->error);
    }

    return $db_con;
}

/**
 * Persist Fan Count for a given Page
 */
function db_save_fancount($page, $fancount)
{
    // Initiate a database connection
    $db_con = db_get_connection();

    // Persist to database
    $sql_insert = sprintf("INSERT INTO fb_fans(page_id, fan_count) VALUES ('%s', %d)", $page, $fancount);
    $db_con->query($sql_insert);
    
    // Release database connection and associated resources
    $db_con->close();
}

/**
 * Get fan counts for a given page
 */
function db_get_fans_data($page)
{
    
    // Initiate a database connection
    $db_con = db_get_connection();

    $sql_data = sprintf("SELECT page_id, UNIX_TIMESTAMP(created_at) AS created_at, fan_count FROM fb_fans WHERE page_id = '%s'", $page);
    $results = $db_con->query($sql_data);

    // Pack it into array
    // for easy conversion to json
    $data = [];
    if ($results->num_rows > 0) {
        while ($row = $results->fetch_assoc()) {
            $data[] = $row;
        }
    }
    
    // Release database connection and associated resources
    $db_con->close();

    return $data;
}


//
// JSON
//

/**
 * Line-chart points
 */
function json_linechart($data)
{
    $template = [
        "error" => false,
        "data" => []
    ];

    $json_data = [];
    foreach ($data as $row) {
        $json_data[] = [
            "date" => $row['created_at'],
            "value" => $row["fan_count"]
        ];
    }

    $template['data'] = $json_data;
    return json_encode($template);
}

/**
 * Tabular by date
 */
function json_table($data)
{
    $template = [
        "error" => false,
        "data" => []
    ];

    $json_data = [];
    foreach ($data as $row) {
        $json_data[] = [
            $row['created_at'] => $row["fan_count"]
        ];
    }

    $template['data'] = $json_data;
    return json_encode($template);
}

/**
 * Page-wise fan counts
 */
function json_multipage($data)
{
    $template = [
        "error" => false,
        "data" => []
    ];

    $json_data = [];
    foreach ($data as $row) {
        $json_data[$row['page_id']][] = [
            $row['created_at'] => $row["fan_count"]
        ];
    }

    $template['data'] = $json_data;
    return json_encode($template);
}
