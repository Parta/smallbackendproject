<?php
// src/AppBundle/Command/CreateUserCommand.php
namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class TestCommand extends Command
{
    protected $client;

    public function __construct()
    {
        parent::__construct();

        $this->client = new Client([
            'base_uri' => 'https://www.facebook.com'
        ]);
    }

    protected function configure()
    {
        $this
            ->setName("test")
            ->setDescription("Just a test command");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $response = $this->client->request('get', '/cocacola');
        $html = $response->getBody()->getContents();

        $text = $this->executeCrawling($html);

        $count = $this->parseText($text);

        $output
            ->writeln($count);
    }

    protected function executeCrawling($html)
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

    protected function parseText($text)
    {
        preg_match("/^\d+(\,\d{3})*/", $text, $matches);
        $stringCount = $matches[0];

        $digitsGroups = explode(',', $stringCount);

        $count = '';
        foreach( $digitsGroups as $dGroup ) {
            $count .= $dGroup;
        }

        return $count;
    }
}
