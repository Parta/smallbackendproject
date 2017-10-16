<?php
namespace AppBundle\Command;

use GuzzleHttp\Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\{
    InputInterface,
    InputArgument
};
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

abstract class PageCrawler extends Command
{
    protected $client, $path;

    public function __construct($baseUri)
    {
        $this->client = new Client([
            'base_uri' => $baseUri
        ]);
        parent::__construct();
    }

    protected function configure()
    {
        $this->addArgument('path', InputArgument::REQUIRED, 'The url path of the fan page of interest.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->container = $this->getApplication()->getKernel()->getContainer();
        $this->em = $this->container->get('doctrine.orm.entity_manager');
        $this->logger = $this->container->get('logger');

        $this->path = $input->getArgument('path');

        // make curl with GuzzleHttpClient to retrieve page's html content
        $response = $this->client->request('get', $this->path);
        $html = $response->getBody()->getContents();

        // crawl the retrieved html content of the page to extract text of interest
        $text = $this->executeCrawling($html);

        // parse the extracted text into an integer of the number of fans displayed in text
        $count = $this->parseText($text);

        // if parsing was succesfull, insert the record in database
        if( $count > -1 ) {
            $this->insertCount($count);
        } else {
            // if parsing failed, log it
            $this->logger->error("The crawler found the requested content, but couldn't parse it to get an integer.", [
                'extracted_text' => $text
            ]);
        }
    }

    protected function insertCount(int $count)
    {
        $pageRepo = $this->em->getRepository($this->pageClass);

        // check in DB if a page for this path exists already
        $page = $pageRepo->findOneByPath($this->path);

        // if it's the first time a crawling is made for the page with the given path, insert it in DB
        if( $page === null ) {
            $page = new $this->pageClass();
            $page->set('path', $this->path);

            $this->em->persist($page);
            $this->em->flush();
        }

        // insert the extracted fan count from crawling in DB
        $fanCount = new $this->fanCountClass();
        $fanCount->setPage($page);
        $fanCount->set('value', $count);
        $fanCount->set('date', new \DateTime());

        $this->em->persist($fanCount);
        $this->em->flush();
    }
}
