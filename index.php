<?php

//import needed parameters for database connection and Facebook API
include 'config.php';

// Extracts key-value pairs as array from command line arguments
function parse_command_line_args($args) {
	$args_as_key_val = array();
	foreach($args as $arg) {
		$tmp = explode('=', $arg, 2);
		if ($arg[0] === '-' && $arg[1] === '-'){
			$args_as_key_val[substr($tmp[0],2)] = $tmp[1];
		}
	}
	return $args_as_key_val
}

//crawls Facebook for the indicated page_id to get desired fan_count data. 
//Returns the fan_count
function get_facebook_fan_count($page_id) {
	
	// construct query url for FB api to get fan_count data. Query returns JSON
	$json_url ='https://graph.facebook.com/v2.8/'.$page_id.'?access_token='.$FB_app_id.'|'.$FB_appsecret.'&fields=fan_count';
	
	//Gets JSON data from query url
	$json = file_get_contents($json_url);
	
	//Convert JSON to PHP array
	$json_output = json_decode($json, true);
	
	//extract the fan_count data and return it
	$fan_count = $json_output["fan_count"];
	return fan_count;
}

function add_data_to_database($page, $count) {
	
	//create new connection to db
	$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
	// check connection
	if ($conn->connect_error) {
		die("Connection failed: ".$conn->connect_error);
	}
	//insert data into database $db_name in table fb_data
	$sql = "INSERT INTO fb_data (company, value) VALUES ($page, $count)";
	$conn->query($sql);
	
	//close connection
	$conn->close();
}

//Parse command line from $argv, array of command line inputs to php. CL parameters start at argv[1]
$input_args = parse_command_line_args(array_slice($argv, 1));

//could expand this later to allow crawling of other social platforms
if ($input_args['platform'] == 'facebook') {
	//Get FB fan count
	$FB_page = input_args['page_id'];
	$count = get_facebook_fan_count(input_args['page_id']);

	//Insert data into database
	add_data_to_database($FB_page, $count);
} else {
	
}


?>