<?php
namespace AppBundle\Command;

use AppBundle\Entity\FanPage\Facebook\{
    FacebookPage,
    FacebookFanCount
};
use GuzzleHttp\Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

class FacebookCrawler extends PageCrawler
{
    protected $client;

    protected $pageClass = FacebookPage::class;
    protected $fanCountClass = FacebookFanCount::class;

    public function __construct()
    {

        $this->client = new Client([
            'base_uri' => 'https://www.facebook.com'
        ]);

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName("test")
            ->setDescription("Just a test command");
    }

    protected function executeCrawling(string $html): string
    {
        $crawler = new Crawler($html);

        $text = $crawler
            ->filter('body #pages_side_column div._4-u2._3xaf._4-u8')
            ->first()
            ->filter('._2pi9._2pi2 ._4bl9 > div')
            ->reduce(function(Crawler $node, $i) {
                return $i === 1;
            })
            ->text();

        return $text;
    }

    protected function parseText(string $text): int
    {
        preg_match("/^\d+(\,\d{3})*/", $text, $matches);
        if( empty($matches) ) {
            return -1;
        }
        $stringCount = $matches[0];

        $digitsGroups = explode(',', $stringCount);

        $count = '';
        foreach( $digitsGroups as $dGroup ) {
            $count .= $dGroup;
        }

        try {
            $count = intval($count);
        } catch( \Exception $e ) {
            $count = -1;
        }

        return $count;
    }
}
