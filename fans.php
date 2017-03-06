<?php

/**
 * Fans API 
 */

require 'config.php';
include 'helpers.php';

// Quick solution, of course, needs to be sanitized
// Using at the least something like Slim would be ideal here.
// Laravel being my personal preference
$page_id = $_REQUEST['page_id'];
$format = $_REQUEST['format'];


// List of formats in which data can be returned
$allowed_formats = [
	'linechart',
	'table',
	'multipage',
	''
];

if(!in_array($format, $allowed_formats)){
	// HTTP 422: Validation Error?
	die('Unsupported format.');
}

// Retrieve data
// In a multipage scenario there maybe multiple page ids
// Assuming, it's a valid single page id
$data = db_get_fans_data($page_id);

switch ($format) {
	case 'table':
		echo json_table(db_get_fans_data($page_id));
		break;
	
	case 'multipage':
		echo json_multipage(db_get_fans_data($page_id));
		break;

	default:
		echo json_linechart(db_get_fans_data($page_id));
		break;
}