<?php session_start();
require_once __DIR__ . '/src/Facebook/autoload.php';
$app = require_once __DIR__ . '/config/config.php'; 
$GLOBALS['db_config'] = $app['db'];

$fb = new Facebook\Facebook([
  'app_id' => '424851427855637',
  'app_secret' => 'c5a0c361d429fdc5e1d862b939987d94',
  'default_graph_version' => 'v2.4',
  ]);
 
$accessToken = getAccessTockenFromDb(); 

if(isset($argv[1]) && strpos($argv[1], '--uri=') === 0){
	$uri = str_replace('--uri=', '', $argv[1]);	 
}else{
	echo "Forget to Pass 1st Argument --uri={Fan page name}";
	exit();
}

if(isset($argv[2]) && strpos($argv[2], '--page_id=') === 0){
	$fb_page_id = str_replace('--page_id=', '', $argv[2]);	 
}else{
	echo "Forget to Pass 2nd Argument --page_id=fb_page_id";
	exit();
}

if (isset($accessToken)) {	
	// getting fan count and inserting into db
	$fan_count = getFanCount($fb_page_id, $accessToken);
	insertHourlyFanCount($fb_page_id, $fan_count, $uri); 
  	
} else {
	 
	echo 'Run index.php to login to Facebook and get long term access_token';
}



function getFanCount($fb_page_id, $accessToken){

	//Below is the request uri to get fan_count from fb page. 
	//We need to have fb_page_id and accessToken
    $json_url ='https://graph.facebook.com/v2.3/' . $fb_page_id . '?fields=fan_count&access_token=' . $accessToken;
 	$json = file_get_contents($json_url);
  	$json_output = json_decode($json);
  
    return $json_output->fan_count;

}

/**
*Below is the which gets stored access_token from db
*
*/
function getAccessTockenFromDb(){

$conn = getDBConnection();

$sql = "SELECT * FROM session ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);
 $result =  $result->fetch_assoc();
 
 foreach ($result as $key => $value) {
 	if($key === 'access_tocken'){
 		return $value;
 	}
 }
$conn->close();

}


function insertHourlyFanCount($fb_page_id, $fan_count, $uri){

$conn = getDBConnection();
$sql = "INSERT INTO fb_hourly_fan_count (`fan_count`, `fb_page_id`, `fb_page_name`)
VALUES ('$fan_count','$fb_page_id', '$uri')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

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