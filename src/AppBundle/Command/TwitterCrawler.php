<?php
namespace AppBundle\Command;

use AppBundle\Entity\FanPage\Twitter\{
    TwitterPage,
    TwitterFanCount
};
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

class TwitterCrawler extends PageCrawler
{

    protected $pageClass = TwitterPage::class;
    protected $fanCountClass = TwitterFanCount::class;

    public function __construct()
    {
        $baseUri = 'https://www.twitter.com';
        parent::__construct($baseUri);
    }

    protected function configure()
    {
        $this
            ->setName("twitter-crawler")
            ->setDescription("Crawls twitter pages to extract and insert number of followers.");

        parent::configure();
    }

    protected function executeCrawling(string $html): string
    {
        /*
         * Crawl Twitter page's html here. Return the text inside the tag of interest
        */

        return '123,456,789 people are #hashtagging this.';
    }

    protected function parseText(string $text): int
    {
        /*
        * Extrat numeric content from retrieved text and return it's integer value
        */

        return -1;
    }
}
