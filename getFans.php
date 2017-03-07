<?php
 
$app = require_once __DIR__ . '/config/config.php'; 
$GLOBALS['db_config'] = $app['db']; 

$fb_page_id = isset($_REQUEST['page_id']) ? $_REQUEST['page_id'] : 'Please specify page_id=fb_page_id in url';
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
	echo $fb_page_id;
}


function LineChart($fb_page_id){
	$conn = getDBConnection();
	$sql = "SELECT date, fan_count, fb_page_name FROM fb_hourly_fan_count";
	$result = $conn->query($sql);
	$data['error'] = false;
	$data['axisY'] = [
		'title' => 'Hourly Fan Count'
	];
	$data['colorSet']  = 'greenshades';
	$data['backgroundColor'] = '#2c2c2c';
	 
	try{
		while($row = $result->fetch_assoc() ) {  
			$temp['x'] = str_replace('-', '', str_replace(' ', '', str_replace(':', '', $row['date'])));
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

	$conn->close();

	return json_encode($data);
		
}

function Table($fb_page_id){
	$conn = getDBConnection();
	$sql = "SELECT date, fan_count FROM fb_hourly_fan_count";
	$result = $conn->query($sql);
	$data['error'] = false;

	try{
		while($row = $result->fetch_assoc() ) {    	 
		   	$data['data'][str_replace('-', '', str_replace(' ', '', str_replace(':', '', $row['date'])))] = $row['fan_count'];        
		}
	 } catch (Exception $e) {
	    echo 'Caught exception: ',  $e->getMessage(), "\n";
	 	$data['error'] = true;
	 }

	$conn->close();

	return json_encode($data); 
}

function MultiplePage($fb_page_id){
	$conn = getDBConnection();
	$sql = "SELECT date, fan_count, fb_page_name FROM fb_hourly_fan_count";
	$result = $conn->query($sql);
	$data['error'] = false;
	 
	try{
		while($row = $result->fetch_assoc() ) {  
			$temp['date'] = str_replace('-', '', str_replace(' ', '', str_replace(':', '', $row['date'])));
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

	$conn->close();

	return json_encode($data);
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