<?php

include 'models/FanCount.php';
include 'JsonBuilder.php';

$baseUrl = 'localhost/smallbackendproject';
$requestUrl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$requestString = substr($requestUrl, strlen($baseUrl));

$urlParams = explode('/', $requestString);

$controller = new FanCount();


$arr = $controller->findAllCompany($_GET['page_id']);

if($arr){
    if(isset($_GET['format'])) {
        switch ($_GET['format']) {
            case 'linechart':
                echo JsonBuilder::getLineChartJson($arr);
                break;
            case 'multiplepage':
                echo JsonBuilder::getMultiplePageJson($arr);
                break;
            case 'table':
                echo JsonBuilder::getTableJson($arr);
                break;
            default:
                echo JsonBuilder::getLineChartJson($arr);
                break;
        }
    } else {
        echo JsonBuilder::getLineChartJson($arr);
    }
}
