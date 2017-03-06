<?php

/**
 * Crawler
 */

require 'config.php';
include 'helpers.php';

// What am I being called for?
// e.g --crawl-for=fb_fans --page-id={page_id}
$cli = parse_cli($_SERVER['argv']);

// Die if what-to-crawl-for is not specified
if (empty($cli['crawl-for'])) {
    die("Unknown crawl request.");
}

// Delegate to corresponding handler
// A ServiceProvider class can be used here which in turn
// new up an available api client (e.g extended HttpClient) and
// get the required data from FB/Twitter etc.
switch ($cli['crawl-for']) {
    case 'fb_fans':
        if (empty($cli['page-id'])) {
            die("Unknown/Missing page id.");
        }

        // Fetch the fan count and save to database table
        db_save_fancount($cli['page-id'], fb_fetch_fancount($cli['page-id']));

        break;
    
        // 
        // Add more cases as and when a ServiceProvider is available.
        // 

    default:
        die("No ServiceProvider available.");
        break;
}
