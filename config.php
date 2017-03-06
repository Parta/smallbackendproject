<?php

/**
 * Application Configuration
 */


$config = [
    'database' => [
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'database' => 'etc'
    ],
    'facebook' => [
        'page_id' => 'cococola',
        'access_token' => "EAACEdEose0cBAIbyAryX4DzkRDo9BSCGqsRZBX3xvCcK8YZAbu1gfZCpRR8vhUtdLnN0RD5XX6VQGwjJcn8IP2PdBZB95pMrgKSDRpZClOupuIlJfHmFZANS5CdZBv5DTZBHDMSRfaaI9fQAzsorOVbmR7b06hrz3JiOea5EZAek74Og472NtZAfZBzkw4ZAdNG1SBMZD", // https://developers.facebook.com/tools/explorer/
        'api_endpoint' => "https://graph.facebook.com/v2.8/"
    ]
];

/**
 * Get Configuration Setting by key
 */
function config($key, $default=null)
{
    global $config;

    // Extract config keys
    list($a, $b) = explode('.', $key);

    if (empty($a)) {
        return $default;
    } elseif (empty($b)) {
        return $config[$a] ? $config[$a] : $default;
    } else {
        return $config[$a][$b] ? $config[$a][$b] : $default;
    }
}
