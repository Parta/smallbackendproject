<?php
// src/AppBundle/Command/CreateUserCommand.php
namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use GuzzleHttp\Client;

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

        print_r($response->getBody()->getContents());

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
