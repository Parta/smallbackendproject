<?php

include 'config.php';

//given FB page ID, get sql 'select' query results from database as an array of associative arrays
function get_data_from_database($page_id) {
	
	//create new connection to db
	$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
	// check connection
	if ($conn->connect_error) {
		die("Connection failed: ".$conn->connect_error);
	}
	//get company data from database as mysql_results object
	$sql = "SELECT date, value FROM fb_data WHERE company = $page_id";
	$query_results = $conn->query($sql);
	
	//convert results into array of associative arrays, one row for each row from query results
	$results = array();
	if ($query_results->num_rows > 0) {
		while($row = $query_results->fetch_assoc()) {
			$results[] = $row;
		}
	}
	
	//close connection
	$conn->close();
	return $results
}

//formats $sql_results into json in the data presentation $format requested
function convert_data_to_formatted_json($results_data, $format, $company){
	switch ($format) {
		//creates linechart json data
		case 'linechart': 
			$formatted_json_output = linechart($results_data);
			break;
		//creates table json data
		case 'table':
			$formatted_json_output = table($results_data);
			break;
		//creates multiplepage json data
		case 'multiplepage':
			$formatted_json_output = multiplepage($results_data, $company);
			break;
		}
	return $formatted_json_output;
}

//converts results dats to linechart json format
function linechart($results) {
	$result = array();
	$data = array();
	
	foreach($results as $row) {
		$data_point = json_encode($row);
		$data[] = $data_point;
	}
	
	$data = json_encode($data);
	
	$result['error'] = false;
	$result['data'] = $data;
	
	$result = json_encode($result);
	
	return $result;
}

//converts results dats to table json format
function table($results) {
	$result = array();
	$data = array();
	foreach($results_data as $row) {
		$data[row['date']] = $row['value'];
	}
	$data = json_encode($data);
	
	$result['error'] = false;
	$result['data'] = $data;
	
	$result = json_encode($result);
	
	return $result;
}

//converts results dats to multiplepage json format
function multiplepage($results) {
	$result = array();
	$data = array();
	$company_data = array();
	
	foreach($results as $row) {
		$data_point = json_encode(row);
		$company_data[] = $data_point;
	}
	
	$company_data = json_encode($company_data);
	
	$data[$company] = $company_data;
	$data = json_encode($data);
	
	$result['error'] = false;
	$result['data'] = $data;
	$result = json_encode($result);
	
	return $result;
}

//identify company id received from query string
$company = $_GET['page_id'];

//NOTE: DO NOT USE THE ABOVE AS IS!!!! JUST A SIMPLIFED SKETCH OF CONCEPT. SANITIZE USER INPUT BEFORE USING FOR SQL QUERY

//Use company id to query data base. Get data from that company
$company_fans_data = get_data_from_database($company);

//Check whether got results back from the database query, or just an empty table
if (count($company_fans_data) > 0) {
	//identify desired output format received from query string
	$json_output_format = $_GET['format'];

	//converts the database results into json in desired format
	$formatted_json_output = convert_data_to_formatted_json($company_fans_data, $json_output_format, $company);
} else {
	$empty = array();
	$formatted_json_output = json_encode($empty);
}


//output formatted json result
echo $formatted_json_output;
?>
