<?php

include 'models/FanCount.php';

$baseUrl = 'localhost/smallbackendproject';
$requestUrl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$requestString = substr($requestUrl, strlen($baseUrl));

$urlParams = explode('/', $requestString);

$controllerName = $urlParams[2];
$actionName =  $urlParams[1].'Action';


$controller = new FanCount();

//build_json depending on format
$arr = $controller->findAll();


?>