<?php

require __DIR__.'/../vendor/autoload.php';

$jobby = new Jobby\Jobby();

$jobby->add('FacebookCrawler/cocacola', [
    'command' => 'php console facebook-crawler cocacola',
    'schedule' => '* */1 * * * *'
]);

$jobby->run();
