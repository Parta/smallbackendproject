<?php
 
$app = require_once __DIR__ . '/config/config.php'; 
$GLOBALS['db_config'] = $app['db']; 

$fb_page_id = isset($_REQUEST['page_id']) ? $_REQUEST['page_id'] : '';
$format = isset($_REQUEST['format']) ?  $_REQUEST['format'] : 'default';
 
if(is_numeric($fb_page_id)){
	switch ($format) {
		case 'linechart':
			echo LineChart($fb_page_id);
			break;
		case 'table':
			echo Table($fb_page_id);
			break;
		case 'multiplepage':
			echo MultiplePage($fb_page_id);
			break;	
		default:			 
			echo Table($fb_page_id);
			break;
	}
}else{
	echo 'Please specify page_id=fb_page_id in url';
}


function LineChart($fb_page_id){
	$result = getFanCountDetailsFromDb($fb_page_id);	 
	$data['error'] = false;
	$data['axisY'] = [
		'title' => 'Hourly Fan Count'
	];
	$data['colorSet']  = 'greenshades';
	$data['backgroundColor'] = '#2c2c2c';
	 
	try{
		while($row = $result->fetch_assoc() ) {  
			$temp['x'] = getFormatedDate($row['date']);
			$temp['y'] = $row['fan_count'];

			if(!isset($data['data'][$row['fb_page_name']])){
				$data['data'] = array();
				$data['data']['type'] = 'line';
				$data['data'][$row['fb_page_name']] = array();				 		 
			}
			  
		    array_push($data['data'][$row['fb_page_name']], $temp); 
		         
		}
	 } catch (Exception $e) {
	    echo 'Caught exception: ',  $e->getMessage(), "\n";
	 	$data['error'] = true;
	 }

	return json_encode($data);
}

function Table($fb_page_id){
	$result = getFanCountDetailsFromDb($fb_page_id);
	$data['error'] = false;

	try{
		while($row = $result->fetch_assoc() ) {    	 
		   	$data['data'][getFormatedDate($row['date'])] = $row['fan_count'];        
		}
	 } catch (Exception $e) {
	    echo 'Caught exception: ',  $e->getMessage(), "\n";
	 	$data['error'] = true;
	 }

	return json_encode($data); 
}

function MultiplePage($fb_page_id){	 
	$result = getFanCountDetailsFromDb($fb_page_id);	 
	$data['error'] = false;
	 
	try{
		while($row = $result->fetch_assoc() ) {  
			$temp['date'] = getFormatedDate($row['date']);
			$temp['value'] = $row['fan_count'];

			if(!isset($data['data'][$row['fb_page_name']])){
				$data['data'][$row['fb_page_name']] = array();
			}

		   	array_push($data['data'][$row['fb_page_name']], $temp);        
		}
	 } catch (Exception $e) {
	    echo 'Caught exception: ',  $e->getMessage(), "\n";
	 	$data['error'] = true;
	 }

	return json_encode($data);
}

//Formating date 2017:03:05 17:30:45 => 20170305173045
function getFormatedDate($date){
	return  str_replace('-', '', str_replace(' ', '', str_replace(':', '', $date)));
}

function getFanCountDetailsFromDb($fb_page_id){
	$conn = getDBConnection();
	$sql = "SELECT date, fan_count, fb_page_name FROM fb_hourly_fan_count Where fb_page_id = {$fb_page_id}";
	$result = $conn->query($sql);
	if($result->num_rows === 0){
		echo 'No result found for fb_page_id: '.$fb_page_id;
		exit();
	}
	$conn->close();

	return $result;
}

function getDBConnection(){ 
	// Create connection
	$conn = new mysqli($GLOBALS['db_config']['host'], $GLOBALS['db_config']['username'], $GLOBALS['db_config']['password'], $GLOBALS['db_config']['db_name']);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

	return $conn;	
}

?>