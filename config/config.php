<?php 

//Database connection settings
$app['db'] = [

	'host' => 'localhost',
	'username' => 'root',
	'password' => '',
	'db_name' => 'fb_graph'

];

$app['fb_app_id'] = '424851427855637';
$app['fb_app_secret'] = 'c5a0c361d429fdc5e1d862b939987d94';
$app['host_url'] = 'http://thisthat.dev/';

return $app;


?>