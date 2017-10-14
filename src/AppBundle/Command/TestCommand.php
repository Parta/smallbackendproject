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

    protected function configure()
    {
        $this->initializeHttpClient();

        $this
            ->setName("test")
            ->setDescription("Just a test command");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $response = $this->client->request('get', '/cocacola');

        $html = $response->getBody()->getContents();

        $crawler = new Crawler($html);
        $texts = $crawler
            ->filter('body #pages_side_column div._4-u2._3xaf._4-u8')
            ->first()
            ->filter('._2pi9._2pi2 ._4bl9 > div')
            ->reduce(function(Crawler $node, $i) {
                return $i === 1;
            })
            ->text();
            
        $output
            ->writeln($texts);


        // print_r("Test command still working!");
        // $output
        //     ->writeln("Test command working!");
    }

    protected function initializeHttpClient()
    {
        $this->client = new Client([
            'base_uri' => 'https://www.facebook.com'
        ]);
    }
}
